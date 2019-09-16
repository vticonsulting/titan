<!DOCTYPE html>
<html lang="en" prefix="og: http://ogp.me/ns#">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php //snippet('titan/meta') ?>
    <?php if ($page->isHomePage()): ?>
      <title><?= $site->title() ?></title>
    <?php else: ?>
      <title><?= $site->title() . ' – ' . $page->title() ?></title>
    <?php endif ?>
    <?= mix('titan/css/titan.css') ?>
    <?= css('assets/css/index.css') ?>
    <!-- mix('default/css/styles.css') -->
    <?= css('@auto', ['defer' => true]) ?>
    <?= css($page->files()->filterBy('extension', 'css')->pluck('url')) ?>

    <!-- Polyfills -->
    <script>
      (function(w, d) {
        function loadJS(url, async){var r=d.getElementsByTagName("script")[0],s=d.createElement("script");if(async)s.async=true;s.src=url;r.parentNode.insertBefore(s,r);}

        // Promise polyfill for IE 11
        if(!window.Promise) {
          loadJS('<?= url('assets/js/polyfills/promise.js') ?>');
        }
      })(window, document);
    </script>

    <?php if (option('keycdn', false) !== false): ?>
      <script>
        window.kirbyConfig = {
          assetsPath: "<?= addslashes(option('keycdn.domain')) ?>/assets/",
        };
      </script>
    <?php endif ?>
    <?= js('assets/js/index.js', ['defer' => true]) ?>
    <?= js('@auto', ['defer' => true]) ?>
    <?= js($page->files()->filterBy('extension', 'js')->pluck('url'), ['defer' => true]) ?>
</head>
<body data-template="<?= $page->template() ?>" class="overflow-y-scroll">
<?php // $skipLink = false ?>
<?php // if (@$skipLink !== false): ?>
  <!-- <a 
    href="#maincontent" 
    class="skip-to-content"
  >Skip to content<span aria-hidden="true"> »</span></a> -->
<?php // endif ?>

<div id="app" class="h-screen flex flex-col">
<?php snippet('titan/site-header', ['background' => @$background ]) ?>
<main id="maincontent" class="flex-1 py-4 px-16">