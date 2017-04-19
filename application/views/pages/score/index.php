<h1>Liste des partitions</h1>

<ul>
    <?php foreach ($scores as $score): ?>
        <li><a href="<?php echo site_url('score/show/' . xss_clean($score->id)) ?>"><?php echo xss_clean($score->name) ?></a> (<a href="<?php echo site_url(['author', 'show', xss_clean($score->author->id)]) ?>"><?php echo xss_clean($score->author->name) ?></a>)</li>
    <?php endforeach; ?>
    <li><a href="<?php echo site_url('score/add') ?>">Ajouter</a></li>
</ul>
