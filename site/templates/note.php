<?php snippet('titan/html-top') ?>

<?php
  echo '<pre>';
  // var_dump($page);
  echo '</pre>';
  // die();
?>
<style>
pre {
  tab-size: 2;
}
</style>

<article class="note">
  <header class="note-header intro">
  <?php if ($page->tags()->isNotEmpty()) : ?>
      <p class="note-tags tags text-sm">
        <?php foreach (Str::split($page->tags()) as $tag): ?>
          <span class="inline-block px-2 rounded tracking-wide uppercase text-xs bg-gray-300">
            <?= $tag ?>
          </span>
        <?php endforeach ?>
      </p>
    <?php endif ?>
    <h1><?= $page->title() ?></h1>
    <time class="note-date">
      <!-- $page->date()->toDate('d F Y') -->
    </time>

  </header>

  <div class="note-text text">
    <?php snippet('toc', $page->text()->headlines('h2')) ?>
    <?= $page->text()->kt()->anchorHeadlines() ?>
  </div>
</article>


<?php snippet('github.edit') ?>

<?php snippet('titan/html-bottom') ?>
