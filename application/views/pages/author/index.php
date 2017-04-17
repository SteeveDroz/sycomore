<h1>Liste des auteurs</h1>

<ul>
    <?php foreach ($authors as $author): ?>
        <li><a href="<?php echo site_url('author/show/' . xss_clean($author->id)) ?>"><?php echo xss_clean($author->name) ?></a></li>
    <?php endforeach; ?>
    <li><a href="<?php echo site_url('author/add') ?>">Ajouter</a></li>
</ul>
