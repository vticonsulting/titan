<!DOCTYPE html>
<html class="no-js" lang="en" prefix="og: http://ogp.me/ns#">
<head>
<?php snippet('meta') ?>
<?= css('assets/sandbox/css/index.css') ?>
<?= css('@auto') ?>

<!--  Replace `no-js` class in root element with `js` -->
<script>(function(cl){cl.remove('no-js');cl.add('js');})(document.documentElement.classList);</script>

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

<?php if (option('keycdn', false) !== false): ?>
  <script>
  window.kirbyConfig = {
    assetsPath: "<?= addslashes(option('keycdn.domain')) ?>/assets/",
  };
  </script>
<?php endif ?>

<?= js('assets/sandbox/js/index.js', ['defer' => true]) ?>
<?= js('@auto', ['defer' => true]) ?>


</head>
<body data-template="<?= $page->template() ?>">

  <a href="#maincontent" class="skip-to-content">Skip to content<span aria-hidden="true"> »</span></a>

  <div class="header<?= r(@$background, ' background:' . @$background) ?>" role="banner">
    <div class="wrap">
      <div class="header-layout">
        <?php snippet('logo') ?>
        <?php snippet('menu', ['background' => @$background ]) ?>
        <?php snippet('search', ['background' => @$background ]) ?>
      </div>
    </div>
  </div>
