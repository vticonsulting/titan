<?php

namespace distantnative\Retour;

class Stats extends Log
{
    public static $file = __DIR__ . '/../../../logs/retour/{x}.stats';

    protected static function defaults(): array
    {
        return [
            'day'   => [],
            'week'  => [],
            'month' => [],
        ];
    }

    public static function count(array $tmp): bool
    {
        $stats = [];

        foreach ($tmp as $item) {
            $time = strtotime($item['date']);
            $stats[date('Y-m', $time)][] = $item;
        }

        foreach ($stats as $year => $items) {
            $data = static::read($year);

            foreach ($items as $item) {
                $time = strtotime($item['date']);
                $structure = [
                    'day'   => [
                        'group' => date('Y-m-d', $time),
                        'key'   => date('Y-m-d H:', $time)
                    ],
                    'month' => [
                        'group' => date('Y-m', $time),
                        'key'   => date('Y-m-d', $time)
                    ]
                ];

                foreach ($structure as $by => $id) {
                    if (isset($data[$by][$id['group']]) === false) {
                        $data[$by][$id['group']] = [];
                    }

                    if (isset($data[$by][$id['group']][$id['key']]) === false) {
                        $data[$by][$id['group']][$id['key']] = [
                            'failed'     => 0,
                            'redirected' => 0
                        ];
                    }

                    $data[$by][$id['group']][$id['key']][$item['status']]++;
                }
            }

            return static::write($data, $year);
        }
    }

    public static function get(string $by, int $offset = 0): array
    {
        switch ($by) {
            case 'day':
                $step  = 60 * 60;
                $start = strtotime(date('Y-m-d 00:00') . $offset . ' day');
                $end   = strtotime(date('Y-m-d 23:59') . $offset . ' day');
                $group = 'Y-m-d';
                $key   = 'Y-m-d H:';
                $label = 'G';
                break;

            case 'week':
                $step    = 60 * 60 * 24;
                $start   = strtotime(date('Y-m-d ', strtotime('Monday this week')) . $offset . ' week');
                $end     = strtotime(date('Y-m-d ', strtotime('Sunday this week')) . $offset . ' week');
                $group   = 'Y-m';
                $key     = 'Y-m-d';
                $label   = 'D';
                $by      = 'month';
                break;

            case 'month':
                $step    = 60 * 60 * 24;
                $start   = strtotime(date('Y-m-01 ') . $offset . ' month');
                $end     = strtotime(date('Y-m-t', $start));
                $group   = 'Y-m';
                $key     = 'Y-m-d';
                $label   = 'j';
                break;
        }

        $source = null;
        $result = [
            'headline'   => static::headline($start, $end),
            'labels'     => [],
            'failed'     => [],
            'redirected' => [],
        ];


        for ($time = $start; $time <= $end; $time += $step) {

            // don't read data twice
            if ($source !== date('Y-m', $time)) {
                $source = date('Y-m', $time);
                $data   = static::read($source);
            }

            $result['labels'][]     = date($label, $time);
            $result['failed'][]     = $data[$by][date($group, $time)][date($key, $time)]['failed'] ?? 0;
            $result['redirected'][] = $data[$by][date($group, $time)][date($key, $time)]['redirected'] ?? 0;
        }

        return $result;
    }

    public static function headline($start, $end): string
    {
        // whole day
        if (date('Y-m-d', $start) === date('Y-m-d', $end)) {
            return date('j F Y', $end);
        }

        // whole month
        if (
            date('Y-m', $start) === date('Y-m', $end) &&
            date('j', $start) === '1' &&
            date('j', $end) === date('t', $end)
        ) {
            return date('F Y', $end);
        }

        // days, same month
        if (
            date('m', $start) === date('m', $end) &&
            date('Y', $start) === date('Y', $end)
        ) {
            return date('j', $start) . '-' . date('j F Y', $end);
        }

        // detailed date
        if (date('Y', $start) === date('Y', $end)) {
            return date('j F', $start) . ' - ' . date('j F Y', $end);
        }

        return date('j F Y', $start) . ' - ' . date('j F Y', $end);
    }
}
