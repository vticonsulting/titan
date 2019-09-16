<?php

use Kirby\Cms\App;

class Cachebuster
{
    protected static $manifest = null;

    protected static function version(string $root, string $path): string
    {
        if (static::$manifest === null) {
            // try to load the manifest file, generated by laravel mix to
            // retrieve content-based hashes of assets files.
            $manifestFile = kirby()->roots()->assets() . '/mix-manifest.json';

            if (file_exists($manifestFile)) {
                static::$manifest = json_decode(file_get_contents($manifestFile), true);
            } else {
                static::$manifest = [];
            }
        }

        $key = preg_replace('/^\/?assets(\/.*)$/', '$1', $path);

        if (isset(static::$manifest[$key]) && preg_match('/\?id=([a-z0-9]+)$/', static::$manifest[$key], $matches)) {
            return substr($matches[1], 0, 8); // only use first 8 chars of hash, that should be enough to be somewhat save
        }

        // Fallback to modified time of assets file, if it
        // has no entry in the manifest file or the entry
        // has no hash.
        return dechex(filemtime($root));
    }

    public static function path(string $path): string
    {
        if (strpos($path, url()) === 0) {
            $path = ltrim(substr($path, strlen(url())), '/');
        }

        $kirby = App::instance();
        $root = $kirby->roots()->index() . '/' . $path;

        if (file_exists($root)) {
            
            $version = static::version($root, $path);

            if (option('cachebuster.mode') === 'path') {
                $path = dirname($path) . '/' . F::name($path) . '.' . $version . '.' . F::extension($path);
            } else {
                $path = $path . '?v=' . $version;
            }
        }

        return $path;
    }

}
