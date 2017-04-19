<?php

echo form_open();
echo form_input(['name' => 'name', 'placeholder' => 'Nom', 'value' => xss_clean($author->name) ?? '']);
echo form_submit('send', xss_clean($submitText));
echo validation_errors();
echo form_close();

 ?>
