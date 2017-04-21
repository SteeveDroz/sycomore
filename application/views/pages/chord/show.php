<h1><?php echo xss_clean($chord->name) ?></h1>

<img src="<?php echo site_url(['chord', 'draw', xss_clean($chord->id)]) ?>" alt="<?php echo xss_clean($chord->name) ?>" />
<a href="<?php echo site_url(['chord', 'edit', xss_clean($chord->id)]) ?>">Éditer</a>
