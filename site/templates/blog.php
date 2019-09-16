<?php snippet('titan/html-top') ?>

<!-- $filteredPages = $page->children()->filterBy('tags', 'design', ','); -->

<!-- $articles = $page->children()
                 ->listed()
                 ->flip()
                 ->paginate(10);

$articles = $page->children()
                 ->listed()
                 ->filterBy('tags', 'design', ',')
                 ->flip()
                 ->paginate(10); -->

<!--
// url: http://yourdomain.com/blog/tag:design
echo param('tag');
// result: design

// url: http://yourdomain.com/blog/tag:fun
echo param('tag');
// result: fun -->

<!-- $articles = $page->children()
                 ->listed()
                 ->filterBy('tags', param('tag'), ',')
                 ->flip()
                 ->paginate(10); -->



<!-- // fetch the basic set of articles
$articles = $page->children()->listed()->flip();

// add the tag filter
if($tag = param('tag')) {
  $articles = $articles->filterBy('tags', $tag, ',');
}

// apply pagination
$articles = $articles->paginate(10); -->

<!-- Tagcloud -->

<?php
// fetch all tags
$tags = $page->children()->listed()->pluck('tags', ',', true);
?>
<ul class="tags">
  <?php foreach($tags as $tag): ?>
  <li>
    <a href="<?= url('blog', ['params' => ['tag' => $tag]]) ?>">
      <?= html($tag) ?>
    </a>
  </li>
  <?php endforeach ?>
</ul>

<?php foreach ($articles as $article): ?>
<?php snippet('article', ['article' => $article]) ?>
<?php endforeach ?>

<nav class="pagination">

  <?php if ($pagination->hasPrevPage()): ?>
  <a href="<?= $pagination->prevPageUrl() ?>">previous articles</a>
  <?php endif ?>

  <?php if ($pagination->hasNextPage()): ?>
  <a href="<?= $pagination->nextPageUrl() ?>">next articles</a>
  <?php endif ?>

</nav>

<?php snippet('titan/html-bottom') ?>
