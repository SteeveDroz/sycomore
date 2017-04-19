<?php

echo form_open();
echo form_input(['name' => 'name', 'placeholder' => 'Nom', 'value' => xss_clean($score->name) ?? '']);
echo form_textarea(['name' => 'content', 'placeholder' => 'Texte', 'value' => xss_clean($score->content) ?? '']);
echo form_dropdown('author', $authors, xss_clean($score->author));
echo form_submit('send', xss_clean($submitText));
echo validation_errors();
echo form_close();

 ?>
