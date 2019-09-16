<?php

Kirby::plugin('superman/superplugin', [
  'options' => [
    'apiKey' => 'default-api-key'
  ],
  'api' => [
    'routes' => [
      [
        'pattern' => 'my-endpoint',
        'action'  => function () {
          return [
            'hello' => 'world'
          ];
        }
      ]
    ]
  ],
  'collections' => [
    'projects' => function ($site) {
      return $site->find('projects')->children()->listed();
    }
  ],
  'controllers' => [
    'blog' => function ($page) {
      return [
        'articles' => $page->children()->listed()
      ];
    }
  ],
  'fieldMethods' => [
    'quote' => function ($field) {
        return '“' . $field->value . '”';
    }
  ],
  'snippets' => [
    'header' => __DIR__ . '/snippets/header.php'
  ],
  'blueprints' => [
    'pages/blog' => [
      'title'    => 'Blog',
      'sections' => [
      ]
    ]
  ]
]);