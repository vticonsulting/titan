<ul>
  <?php foreach(page('projects')->children()->published()->limit(3) as $project): ?>
  <li>
    <a href="<?= $project->url() ?>">
      <img src="<?= $project->cover()->url() ?>" alt="<?= $project->title() ?>" />
    </a>
  </li>
  <?php endforeach ?>
</ul>
