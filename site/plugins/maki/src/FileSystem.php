<?php

namespace Kirby\Maki;

use Kirby\Toolkit\F;
use Kirby\Toolkit\Str;

class FileSystem
{

    /**
     * File System Icons
     */
    public static $types = [
        'gulpfile'   => '/^gulpfile.js$/i',
        'readme'     => '/^(readme|license)\.?/i',
        'javascript' => ['js'],
        'css'        => ['css'],
        'html'       => ['html', 'htm', 'xhtml'],
        'font'       => ['woff', 'woff2', 'ttf', 'otf', 'eot'],
        'code'       => ['json'],
        'yaml'       => ['yaml'],
        'markdown'   => ['md', 'mdown', 'markdown'],
        'git'        => ['git', 'gitattributes', 'gitignore', 'gitmodules'],
        'php'        => ['php'],
        'yaml'       => ['yml'],
        'text'       => ['txt'],
    ];

    protected static function getIcon($icon): string
    {
        return icon($icon, true);
    }

    protected static function getIconByFilename($filename): string
    {

        $extension = F::extension($filename);
        $icon      = F::type($filename);

        foreach (static::$types as $type => $extensions) {
            if ((is_string($extensions) && preg_match($extensions, $filename)) || (is_array($extensions) && in_array($extension, $extensions))) {
                $icon = $type;
                break;
            }
        }

        return static::getIcon($icon ?? 'file');
    }

    public static function parse($text): string
    {
        return static::renderBlock(static::parseBlock($text));
    }

    // Source: http://stackoverflow.com/a/8882181
    protected static function parseBlock($text): array
    {

        $indentation = '  ';

        $result = [];
        $path   = [];

        foreach (explode("\n", $text) as $line) {
            // get depth and label
            $depth = 0;

            while (substr($line, 0, strlen($indentation)) === $indentation) {
                $depth += 1;
                $line = substr($line, strlen($indentation));
            }

            // truncate path if needed
            while ($depth < sizeof($path)) {
                array_pop($path);
            }

            // keep label (at depth)
            $path[$depth] = $line;

            // traverse path and add label to result
            $parent =& $result;

            foreach ($path as $depth => $key) {
                if (!isset($parent[$key])) {
                    $parent[$line] = array();
                    break;
                }

                $parent =& $parent[$key];
            }
        }

        // return
        return $result;
    }

    protected static function renderBlock($files): string
    {
        $html = '';
        $html .= '<ul class="filesystem-items">';

        foreach ($files as $filename => $children) {

            $hasChildren = count($children) > 0;
            $isFolder    = Str::endsWith($filename, '/');

            if ($isFolder) {
                $icon     = $hasChildren ? 'folder-expanded' : 'folder-collapsed';
                $icon     = static::getIcon($icon);
                $filename = preg_replace('/\/$/', '', $filename);
            } elseif(in_array($filename, ['...', '…'])) {
                $icon = '';
            } else {
                $icon = static::getIconByFilename($filename);
            }

            $class = [];

            if (empty($icon)) {
                $class[] = 'has-no-icon';
            }

            if ($hasChildren) {
                $class[] = 'has-children';
            }

            $html .= '<li' . ((count($class) > 0) ? ' class="' . implode(' ', $class) . '"' : '') . '>';
            $html .= "{$icon}<span>{$filename}</span>";

            if ($hasChildren) {
                $html .= static::renderBlock($children);
            }

            $html .= '</li>';
        }

        $html .= '</ul>';

        return $html;

    }

}

// ```filesystem
// content/
//   1-projects/
//     project-a/
//       .git
//       .gitattributes
//       archive.zip
//       css.css
//       file.unknown
//       font.eot
//       font.otf
//       font.ttf
//       font.woff
//       font.woff2
//       gulpfile.js
//       html.html
//       image-1.jpg
//       image-2.jpg
//       image-3.jpg
//       js.js
//       json.json
//       markdown.md
//       markdown.mdown
//       php.php
//       project-data.xls
//       project-info.pdf
//       project.txt
//       readme.md
//       LICENSE
//       some-audio.mp3
//       some-video.mp4
//       xml.xml
//       yaml.yml
//     project-b/
//       ...
//   2-about/
// ```
