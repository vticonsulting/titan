<?php

// Bnomei\Dotenv::load();

// echo env('APP_MODE'); // production
// or
// echo $page->getenv('ALGOLIA_APIKEY'); // 12d7331a21d8a28b3069c49830f463e833e30f6d

return [
  'algolia' => require __DIR__ . '/algolia.php',
  'routes'  => require __DIR__ . '/routes.php',
  'api' => [
    'allowInsecure' => true,
    'routes' => [
      [
        'pattern' => 'config-endpoint',
        'action'  => function () {
          return [
            'hello' => 'world'
          ];
        }
      ]
    ]
  ],
  'cache' => [
    'pages' => [
      'active' => false,
      'ignore' => function ($page) {
          return $page->title()->value() === 'Do not cache me';
      }
    ]
  ],
  'content' => [
    'extension' => 'txt',
    'ignore' => []
  ],
  'debug' => true,
  'github'  => 'https://github.com/vticonsulting',
  'home' => 'home',
  'hooks' => require_once 'hooks.php',
  // 'kirbytext' => [
  //   'video' => [
  //     'class' => 'video',
  //     'height' => false,
  //     'width' => false
  //   ]
  // ],
  'languages' => true,
  'markdown' => [
    'extra' => true,
    'breaks' => true,
  ],
  'panel' => false,
  // 'panel' => [
  //   'css' => 'assets/css/custom-panel.css',
  //   'kirbytext' => true,
  //   'install' => true,
  //   'js' => 'assets/js/panel.js',
  //   'slug' => 'panel'
  // ],
  'plugins' => [
    'categories' => [
        'panel'         => ['icon' => 'panel', 'label' => 'Panel'],
        'templating'    => ['icon' => 'html', 'label' => 'Templating'],
        'seo'           => ['icon' => 'seo', 'label' => 'SEO'],
        // 'accessibility' => ['icon' => 'user', 'label' => 'Accessibility'],
        'security'      => ['icon' => 'lock', 'label' => 'Security'],
        'performance'   => ['icon' => 'performance', 'label' => 'Performance'],
        'analytics'     => ['icon' => 'analytics', 'label' => 'Analytics'],
        'assets'        => ['icon' => 'image', 'label' => 'Assets'],
        'text'          => ['icon' => 'text', 'label' => 'Text'],
        'forms'         => ['icon' => 'forms', 'label' => 'Forms'],
        'utilities'     => ['icon' => 'wand', 'label' => 'Utilities'],
        'integrations'  => ['icon' => 'integration', 'label' => 'Integrations'],
        'social'        => ['icon' => 'twitter', 'label' => 'Social Networking']
    ]
    ],
  'thumbs' => [
    'presets' => [
      'default' => [
        'width' => 1024,
        'quality' => 80
      ],
      'banner' => [
        'width' => 1024,
        'height' => 342,
        'crop' => true
      ],
      'blurred' => [
        'blur' => true
      ]
    ]
  ],
  'routes'  => require __DIR__ . '/routes.php',
  'smartypants' => true,
  'superman.superplugin.apiKey' => 'my-custom-key',
  'diverently.laravel-mix-kirby.manifestPath' => 'assets/mix-manifest.json',
  'diverently.laravel-mix-kirby.assetsDirectory' => 'assets',
  'beebmx.kirby-db.drivers' => [
    'sqlite' => [
      'driver' => 'sqlite',
      'database' => 'storage/database/database.sqlite',
      'prefix' => ''
    ]
  ],
  'quote.default_style' => 'bs',
];
