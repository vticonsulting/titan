<?php

declare(strict_types=1);

namespace Bnomei;

final class Doctor
{
    private static $cache = null;
    private static function cache(): \Kirby\Cache\Cache
    {
        if (! self::$cache) {
            self::$cache = kirby()->cache('bnomei.doctor');
        }
        return self::$cache;
    }

    public static function readCheckDefaults($file = null): ?array
    {
        $file = $file ?? realpath(__DIR__ . '/../doctor-checks-defaults.json');
        if (file_exists($file)) {
            return json_decode(file_get_contents($file), true);
        } else {
            return [];
        }
    }

    private static function checksList(): array
    {
        $defaults = self::readCheckDefaults();
        if (function_exists('option')) {
            $checks = option('bnomei.doctor.checks');
            if (is_array($defaults) && is_array($checks)) {
                $defaults = array_merge($defaults, $checks);
            }
        }
        if (function_exists('kirby')) {
            $pluginChecks = [];
            foreach (kirby()->plugins() as $plugin) {
                $pluginChecks = array_merge($pluginChecks, $plugin->extends()['bnomei.doctor.checks'] ?? []);
            }
            $defaults = array_merge($defaults, $pluginChecks);
        }
        $validChecks = [];
        foreach ($defaults as $classname => $enabled) {
            if (! $enabled) {
                continue;
            }
            if (class_exists($classname)) {
                $validChecks[] = $classname;
            }
        }
        return $validChecks;
    }

    private static function runner(): \ZendDiagnostics\Runner\Runner
    {
        $runner = new \ZendDiagnostics\Runner\Runner();

        $runner->addCheck(new \ZendDiagnostics\Check\PhpVersion('7.2', '>'));
        $runner->addCheck(new \ZendDiagnostics\Check\ExtensionLoaded([
            'mbstring',
            'curl',
            'gd',
        ]));

        if (function_exists('kirby')) {
            $checkReadable = new \ZendDiagnostics\Check\DirReadable([
                kirby()->roots()->assets(),
                kirby()->roots()->blueprints(),
                // kirby()->roots()->collections(),
                kirby()->roots()->config(),
                // kirby()->roots()->controllers(),
                // kirby()->roots()->emails(),
                kirby()->roots()->index(),
                // kirby()->roots()->lanuages(),
                // kirby()->roots()->models(),
                kirby()->roots()->panel(),
                // kirby()->roots()->plugins(),
                // kirby()->roots()->roles(),
                kirby()->roots()->site(),
                // kirby()->roots()->snippets(),
                kirby()->roots()->templates(),
            ]);
            $runner->addCheck($checkReadable);

            $checkWriteable = new \ZendDiagnostics\Check\DirWritable([
                kirby()->roots()->accounts(),
                kirby()->roots()->cache(),
                kirby()->roots()->media(),
                kirby()->roots()->sessions(),
                kirby()->roots()->config(), // write .license file
            ]);
            $runner->addCheck($checkWriteable);
        }

        foreach (self::checksList() as $checkClass) {
            $runner->addCheck(new $checkClass());
        }
        return $runner;
    }

    public static function cli(): int
    {
        $runner = self::runner();
        $runner->addReporter(new \ZendDiagnostics\Runner\Reporter\BasicConsole(80, true));
        $results = $runner->run();
        return ($results->getFailureCount() + $results->getWarningCount()) > 0 ? 1 : 0;
    }

    public static function check($force = false): ?array
    {
        $forceDebug = $force || (option('bnomei.doctor.forcedebug') && option('debug'));
        $expire = intval(option('bnomei.doctor.expire'));
        $id = sha1(site()->url());

        $checkResult = self::cache()->get($id);

        if (! $forceDebug && $checkResult) {
            return $checkResult;
        }

        $runner = self::runner();
        $runner->addReporter(new \Bnomei\DoctorReporter());
        $results = $runner->run();
        $checks = [];
        foreach ($results as $result) {
            $result = $results[$result];
            $rtype = 'Success';
            if ($result instanceof \ZendDiagnostics\Result\SkipInterface) {
                $rtype = 'Skip';
            } elseif ($result instanceof \ZendDiagnostics\Result\WarningInterface) {
                $rtype = 'Warning';
            } elseif ($result instanceof \ZendDiagnostics\Result\FailureInterface) {
                $rtype = 'Failure';
            }
            $checks[] = [
                'message' => $result->getMessage(),
                'result' => $rtype,
            ];
        }
        // $checks = \Kirby\Toolkit\A::sort($checks, 'result');
        self::cache()->set($id, $checks, $expire);

        return $checks;
    }

    public static function log(string $msg = '', string $level = 'info', array $context = []): bool
    {
        $log = option('bnomei.doctor.log');
        if ($log && is_callable($log)) {
            if (! option('debug') && $level === 'debug') {
                // skip but...
                return true;
            } else {
                return $log($msg, $level, $context);
            }
        }
        return false;
    }

    public static function findComposerLockFile(): ?string
    {
        foreach ([
            kirby()->roots()->index() . '/composer.lock', // plainkit
            realpath(kirby()->roots()->index() . '/../composer.lock'), // devkit
            realpath(kirby()->roots()->index() . option('bnomei.doctor.checkcomposerlocksecurity.path', '')),
        ] as $path) {
            if (\Kirby\Toolkit\F::exists($path)) {
                return $path;
            }
        }
        return null;
    }
}
