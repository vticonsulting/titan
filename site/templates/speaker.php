<ul>
<li>about: <?= $page->about() ?>
<li>title: <?= $page->title() ?>
<li>link: <?= $page->link() ?>
<li>talk: <?= $page->talk() ?>
<li>teaser: <?= $page->teaser() ?>
<li>time: <?= $page->time() ?>
<li>venue: <?= $page->venue() ?>
</ul>

<a href="<?= $page->document('mister-burns-cv.pdf')->url() ?>">
Download CV
</a>
<br>

niceSize: <?= $page->document('mister-burns-cv.pdf')->niceSize() ?>
<!-- will echo something like 405.4 kb or 5.2 MB -->