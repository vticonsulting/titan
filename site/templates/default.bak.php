<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <?= css('/media/plugins/s1syphos/highlight/css/zenburn.css') ?>
  <?= css('/assets/default/css/styles.css') ?>
</head>
<body>
<?php if ($page->intro()->isNotEmpty()): ?>
<p class="intro">
  <?= $page->intro()->kirbyTextInline() ?>
</p>
<?php endif ?>

<!--
  <img
  src="<?= $image->thumb('banner')?>"
  alt="<?= $image->alt()?>"
  class="banner"
>
-->

<?php if ($kirby->user()): ?>
  <a href="<?= $page->panelUrl() ?>">EDIT</a>
<?php endif ?>


<img
  src="<?= $image->url() ?>"
  srcset="<?= $image->srcset([300, 800, 1024]) ?>"
/>


<h1><?= $page->title()->html() ?></h1>

<h1>Collections</h1>

<h2>Articles</h2>
<?php echo $kirby->collection("articles") ?>

<h2>Notes</h2>
<?php echo $kirby->collection("notes") ?>

<h2>Admins</h2>
<?php echo $kirby->collection("admins") ?>

<h2>Project Covers</h2>
<?php echo $kirby->collection("project-covers") ?>



<?php  // print_r($page) ?>
<?php  // var_dump($page) ?>
<?= kirby()->version() ?>

<h1><?= $page->title()->html() ?></h1>

<?php snippet('mysnippet', ['title' => 'Hello!']) ?>

<?php // $emailBody = snippet('email', ['data' => $data], true); ?>
<!-- $filteredPages = $page->children()->filterBy('tags', 'design', ','); -->

<a href="https://twitter.com/intent/tweet?source=webclient&text=<?= rawurlencode($page->title()); ?>%20<?= rawurlencode($page->url()); ?>%20<?= ('via @your_account')?>" target="_blank" title="Tweet this">
 Tweet
</a>

<a href="http://www.facebook.com/sharer.php?u=<?= rawurlencode ($page->url()); ?>" target="_blank" title="Share on Facebook">
  Share on Facebook
</a>

<?= $page->text()->kirbytext() ?>
<?= $page->title()->quote() ?>
<h2>Latest Projects</h2>

<?php
// we create an array of tags from all child pages of the current child
$tags = $page->children()->pluck('tags', ',', true);

// if the $tags array is not empty, the execution of the script is halted with a message
if (!empty($tags)) {
    die('Breakpoint 1: $tags is not empty');
}
?>




<!-- $kirby->collection("articles");
$kirby->collection("articles/latest");
$kirby->collection("admins");
$kirby->collection("project-covers"); -->

<!-- Fetching all images of a page -->
<?php foreach($page->images() as $file): ?>
    <img src="<?= $file->url() ?>">
<?php endforeach ?>

<!-- Fetch a single file  -->
<?php if($file = $page->file()): ?>
<?= $file->filename() ?>
<?php endif ?>

<!-- Fetching friles from site -->
<?php foreach($site->images() as $file): ?>
    <img src="<?= $file->url() ?>">
<?php endforeach ?>

<!-- Fetching all image from subpages -->
<?php foreach($page->children()->images() as $file): ?>
    <img src="<?= $file->url() ?>">
<?php endforeach ?>

<!-- Filter images by template -->
<?php foreach($page->images()->template('gallery') as $file): ?>
    <img src="<?= $file->url() ?>">
<?php endforeach ?>




<?= $kirby->plugin('superman/superplugin')->version() ?>
<?= $kirby->plugin('superman/superplugin')->description() ?>
<?= $kirby->plugin('superman/superplugin')->license() ?>
<?= $page->getenv('ALGOLIA_APIKEY'); ?>
<?php $kirby->plugin('superman/superplugin')->authors() ?>

<?php
// $content = [
//   'title' => 'An interesting title',
//   'text'  => 'Some great content here…'
// ];
// $page->createChild([
//   'content'  => $content,
//   'slug'     => 'test-article',
//   'template' => 'article'
// ]);
?>


</body>
</html>
