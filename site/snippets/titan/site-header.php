<header id="site-header" class="<?= r(@$background, ' background:' . @$background) ?> py-2 px-16 flex justify-between bg-gray-800 text-white items-center" role="banner">
  <?php snippet('titan/site-header-logo') ?>
  <?php snippet('menu', ['background' => @$background ]) ?>
  <?php // snippet('titan/site-header-nav') ?>
</header>
