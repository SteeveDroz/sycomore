<?php

echo form_open();
echo form_input(['name' => 'name', 'placeholder' => 'Nom', 'value' => $name??'']);
echo form_submit('add', 'Ajouter');
echo validation_errors();
echo form_close();
 ?>
<a href="<?php echo site_url('author') ?>">Retour</a>
