<?php

// nested menu
$items = $pages->listed();

// only show the menu if items are available
if($items->isNotEmpty()):

?>
<nav>
  <ul>
    <?php foreach($items as $item): ?>
    <li>
      <a<?php e($item->isOpen(), ' class="active"') ?> href="<?= $item->url() ?>"><?= $item->title()->html() ?></a>

      <?php

      // get all children for the current menu item
      $children = $item->children()->listed();

      // display the submenu if children are available
      if($children->isNotEmpty()):

      ?>
      <ul>
        <?php foreach($children as $child): ?>
        <li><a<?php e($child->isOpen(), ' class="active"') ?> href="<?= $child->url() ?>"><?= $child->title()->html() ?></a></li>
        <?php endforeach ?>
      </ul>
      <?php endif ?>

    </li>
    <?php endforeach ?>
  </ul>
</nav>
<?php endif ?>