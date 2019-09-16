<?php if($image = $page->image('lake.jpg')): ?>
  <figure>
    <img src="<?= $image->url() ?>" alt="<?= $image->title() ?>">
    <figcaption>
      <span class="caption">
        <?= $image->caption() ?>
      </span>
      <span class="photographer">
        <?= $image->photographer() ?>
      </span>
    </figcaption>
  </figure>
<?php endif ?>