<h1><?php echo xss_clean($author->name) ?></h1>
<a href="<?php echo site_url('author/edit/' . xss_clean($author->id)) ?>">Éditer</a>
