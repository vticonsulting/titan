<?php 

// A list of pages
return function ($site) {
    return $site->find('notes')->children()->listed()->flip();
};