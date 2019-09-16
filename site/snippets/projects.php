<ul class="projects">
  <?php foreach (page('projects')->children()->shuffle() as $project): ?>
  <?php if ($image = $project->image()): ?>
  <li>
    <img src="<?= $image->url() ?>" alt="<?= $project->title() ?>">
  </li>
  <?php endif ?>
  <?php endforeach ?>
</ul>
