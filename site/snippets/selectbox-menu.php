<?php

// main menu items
$items = $pages->listed();

// only show the menu if items are available
if($items->isNotEmpty()):

?>
<select onchange="window.location.href = this.value">
  <?php foreach($items as $item): ?>
  <option value="<?= $item->url() ?>"<?php e($item->isOpen(), ' selected="selected"') ?>><?= $item->title()->html() ?></option>
  <?php endforeach ?>
</select>
<?php endif ?>