<?php snippet('titan/html-top', [ 'background' => 'dark' ]) ?>

  <main class="cases-page | main" id="maincontent">
    <article class="wrap">

      <?php snippet('hero') ?>

      <ul class="cases-grid">
        <?php foreach ($page->children()->listed()->shuffle() as $case): ?>
        <li>
          <article>
            <a href="<?= $case->link()->toUrl() ?>">
              <h2 class="h5"><?= $case->title() ?></h2>
              <p class="h6 -mb:medium">
                <?= Url::short(Url::base($case->link()->value())) ?>
              </p>
              <figure class="screenshot">
                <span class="intrinsic" style="padding-bottom: 133.33%">
                  <?= $case->cover()->toFile() ?? $case->image() ?>
                </span>
              </figure>
            </a>
          </article>
        </li>
        <?php endforeach ?>
      </ul>

      <div class="text description">
        <p>
          <strong>You built something with Kirby?</strong>
          <br>We have a <a href="https://forum.getkirby.com/t/made-with-kirby-and-3/83/434">public thread in our forum</a> where you can share your work with other Kirby users.
        </p>
      </div>

    </article>
  </main>

  <?php snippet('titan/html-bottom', [ 'background' => 'dark' ]) ?>
