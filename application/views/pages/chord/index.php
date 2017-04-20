<h1>Liste des accords</h1>

<ul>
    <?php foreach ($chords as $chord): ?>
        <li><a href="<?php echo site_url(['chord', 'show', xss_clean($chord->id)]) ?>"><?php echo xss_clean($chord->name) ?></a></li>
    <?php endforeach; ?>
    <li><a href="<?php echo site_url(['chord', 'add']) ?>">Ajouter</a></li>
</ul>
