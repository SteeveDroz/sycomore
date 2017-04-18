<h1>Liste des accords</h1>

<ul>
    <?php foreach ($scores as $score): ?>
        <li><a href="<?php echo site_url('score/show/' . xss_clean($score->id)) ?>"><?php echo xss_clean($score->name) ?></a></li>
    <?php endforeach; ?>
    <li><a href="<?php echo site_url('score/add') ?>">Ajouter</a></li>
</ul>
