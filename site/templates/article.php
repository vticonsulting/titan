<?php snippet('titan/html-top') ?>

<article>

  <h1><?= $page->title()->html() ?></h1>
  <time><?= $page->date()->toDate('d.m.Y') ?></time>
  <?= $page->text()->kirbytext() ?>

  <?php if($author = $page->author()->toUser()): ?>
    <aside class="author">

      <h1><?= $author->name() ?></h1>

      <?php if($avatar = $author->avatar()): ?>
        <figure>
          <img src="<?= $avatar->url() ?>">
        </figure>
      <?php endif ?>

      <?= $author->bio()->kirbytext() ?>

      <h2>On the web:</h2>

      <ul>
        <li><a href="<?= $author->website() ?>">Website</a></li>
        <li><a href="<?= $author->twitter() ?>">Twitter</a></li>
      </ul>

    </aside>
  <?php endif ?>
</article>

<?php snippet('titan/html-bottom') ?>
