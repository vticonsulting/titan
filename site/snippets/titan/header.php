<head>

<?php if ($page->isHomePage()): ?>
<title><?= $site->title() ?></title>
<?php else: ?>
<title><?= $site->title() . ' – ' . $page->title() ?></title>
<?php endif ?>

<!-- custom css -->
<?= css($page->files()->filterBy('extension', 'css')->pluck('url')) ?>

<!-- custom javascript -->
<?= js($page->files()->filterBy('extension', 'js')->pluck('url')) ?>
</head>