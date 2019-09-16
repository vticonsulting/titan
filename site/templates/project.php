<!DOCTYPE html>
<html class="no-js" lang="en" prefix="og: http://ogp.me/ns#">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <?php snippet('meta') ?>
  <title>Project</title>
  <?= css('assets/shared/css/latofonts.css') ?>
  <?= css('assets/default/css/styles.css') ?>
  <?= css('assets/sandbox/css/index.css') ?>
  <?= css('@auto') ?>

  <!-- Polyfills -->
  <script>
  (function(w, d) {
    function loadJS(url, async){var r=d.getElementsByTagName("script")[0],s=d.createElement("script");if(async)s.async=true;s.src=url;r.parentNode.insertBefore(s,r);}
    // Promise polyfill for IE 11
    if(!window.Promise) {
      loadJS('<?= url('assets/sandbox/js/polyfills/promise.js') ?>');
    }
  })(window, document);
  </script>

  <?= js('assets/shared/js/clipboard.js') ?>
  <?= js('assets/sandbox/js/index.js', ['defer' => true]) ?>

  <?= js('@auto', ['defer' => true]) ?>
</head>
<body class="p-32" style="font-family: 'LatoWeb'" data-template="<?= $page->template() ?>">
  <a href="#maincontent" class="skip-to-content">Skip to content<span aria-hidden="true"> »</span></a>
  <div class="header<?= r(@$background, ' background:' . @$background) ?>" role="banner">
    <div class="wrap">
      <div class="header-layout">
        <?php snippet('logo') ?>
        <?php snippet('menu', ['background' => @$background ]) ?>
      </div>
    </div>
  </div>
  <main class="docs-page | main" id="maincontent">
    <div class="wrap">
      <div class="docs-grid">
        <article class="docs-content">
          <header>
            <h1><?= $page->title()->html()->widont() ?></h1>
          </header>


          <?php if ($page->intro()->isNotEmpty()): ?>
          <div class="text intro -mb:large">
            <?= $page->intro()->kt() ?>
          </div>
          <?php endif ?>

          <?php snippet('toc', $page->text()->headlines('h2')) ?>

          <div class="text">
            <?= $page->text()->kt()->anchorHeadlines() ?>
          </div>

          <div class="font-black text-3xl"><?= $page->headline()->html() ?></div>
          <div class=""><?= $page->year()->html() ?></div>
          <div class="" font-style: italic"><?= $page->tags()->html() ?></div>
          <div class=""><?= $page->intro()->html() ?></div>

          <?php snippet('github.edit') ?>

          <?= $page->text()->kt() ?>
          <?= $kirby->root('accounts') ?>
          <?= $kirby->root('assets') ?>
          <?= $kirby->root('blueprints') ?>
          <?= $kirby->root('cache') ?>
          <?= $kirby->root('collections') ?>
          <?= $kirby->root('config') ?>
          <?= $kirby->root('content') ?>
          <?= $kirby->root('controllers') ?>
          <?= $kirby->root('index') ?>
          <?= $kirby->root('kirby') ?>
          <?= $kirby->root('media') ?>
          <?= $kirby->root('plugins') ?>
          <?= $kirby->root('roles') ?>
          <?= $kirby->root('sessions') ?>
          <?= $kirby->root('site') ?>
          <?= $kirby->root('snippets') ?>
          <?= $kirby->root('templates') ?>




          <p class="font-hairline">The quick brown fox ...</p>
          <p class="font-thin">The quick brown fox ...</p>
          <p class="font-light">The quick brown fox ...</p>
          <p class="font-normal">The quick brown fox ...</p>
          <p class="font-medium">The quick brown fox ...</p>
          <p class="font-semibold">The quick brown fox ...</p>
          <p class="font-bold">The quick brown fox ...</p>
          <p class="font-extrabold">The quick brown fox ...</p>
          <p class="font-black">The quick brown fox ...</p>
        </article>
      </div>
    </div>
  </main>
</body>
</html>
