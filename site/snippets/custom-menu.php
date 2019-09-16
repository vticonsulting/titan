<?php

// selective items

$items = $pages->find('terms-of-service', 'faq', 'support');

if($items and $items->isNotEmpty()):

?>
<nav>
  <ul>
    <?php foreach($items as $item): ?>
    <li><a<?php e($item->isOpen(), ' class="active"') ?> href="<?= $item->url() ?>"><?= $item->title()->html() ?></a></li>
    <?php endforeach ?>
  </ul>
</nav>
<?php endif ?>