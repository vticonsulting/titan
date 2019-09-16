<?php
return [
  'page.delete:before' => function (Page $page) {
    // do something before a page gets deleted
    if ($this->user()->email() !== 'overlord@ourcompany.com') {
      throw new Exception('Only our overlord and savior can delete pages');
    }
  }
];