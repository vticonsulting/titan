<!-- # Features -->
<section id="features" class="home-features | section">
  <h2 class="visually-hidden">Features</h2>
  <div class="wrap">
    <ul>
      <?php foreach($page->find('features')->children() as $feature): ?>
        <li>
          <figure>
            <?= $feature->image()->read() ?>
          </figure>
          <h3><?= $feature->title() ?></h3>
          <div class="description"><?= $feature->text()->kt() ?></div>
        </li>
      <?php endforeach ?>
    </ul>
    <p><a class="home-features-more" href="<?= url('features') ?>">Not convinced yet? Find out why Kirby is made for you &rsaquo;</a></p>
  </div>
</section>
