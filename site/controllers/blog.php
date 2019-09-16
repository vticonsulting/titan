<?php

return function ($page) {

  // get all articles
  $articles = $page->children()->listed()->flip();

  // add a tag filter
  if ($tag = get('tag')) {
    $articles = $articles->filterBy('tags', '=', $tag, ',');
  }

  // add the tag filter
  // if($tag = param('tag')) {
  //   $articles = $articles->filterBy('tags', $tag, ',');
  // }

   // fetch all tags
  $tags = $articles->pluck('tags', ',', false);

  // add pagination
  $articles = $articles->paginate(20);

  // create a shortcut for pagination
  $pagination = $articles->pagination();

  // pass $articles and $pagination to the template
  return [
    'articles' => $articles,
    'tags' => $tags,
    'tag' => $tag,
    'pagination' => $pagination
  ];

};