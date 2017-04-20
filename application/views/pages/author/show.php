<h1><?php echo xss_clean($author->name) ?></h1>
<ul>
    <?php foreach ($scores as $score): ?>
        <li><a href="<?php echo site_url(['score', 'show', xss_clean($score->id)]) ?>"><?php echo xss_clean($score->name) ?></a></li>
    <?php endforeach; ?>
    <li><a href="<?php echo site_url(['score', 'add', xss_clean($author->id)]) ?>">Ajouter</a></li>
</ul>
<a href="<?php echo site_url('author/edit/' . xss_clean($author->id)) ?>">Éditer</a>
