<h1><?php echo xss_clean($score->name) ?> (<a href="<?php echo site_url(['author', 'show', xss_clean($score->author->id)]) ?>"><?php echo xss_clean($score->author->name) ?></a>)</h1>

<?php echo xss_clean($score->content) ?>
<a href="<?php echo site_url(['score', 'edit', xss_clean($score->id)]) ?>">Éditer</a>
