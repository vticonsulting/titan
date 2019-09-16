<?php

// A list of images/files
return function ($site) {
    return $site
        ->find('projects')
        ->children()
        ->images()
        ->template('cover');
};