<?php 

// A list of pages
return function ($site) {
    return $site->find('blog')->children()->listed()->flip();
};