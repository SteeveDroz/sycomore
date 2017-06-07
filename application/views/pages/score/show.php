<h1><?php echo xss_clean($score->name) ?> (<a href="<?php echo site_url(['author', 'show', xss_clean($score->author->id)]) ?>"><?php echo xss_clean($score->author->name) ?></a>)</h1>

<?php foreach ($chords as $chord): ?>
    <?php
    $link = $chord->id == 0 ? site_url(['chord', 'add', xss_clean($chord->name)]) : site_url(['chord', 'show', xss_clean($chord->id)]);
    ?>
    <a href="<?php echo $link ?>"><img src="<?php echo site_url(['chord', 'draw', $chord->id]) ?>"></a>
<?php endforeach; ?>
<?php echo xss_clean($score->content) ?>
<a href="<?php echo site_url(['score', 'edit', xss_clean($score->id)]) ?>">Éditer</a>
