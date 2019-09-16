<nav>
  <ul>
    <?php foreach($site->breadcrumb() as $crumb): ?>
    <li<?php e($crumb->isActive(), ' class="is-active"') ?>><a href="<?= $crumb->url() ?>"><?= $crumb->title()->html() ?></a></li>
    <?php endforeach; ?>
  </ul>
</nav>