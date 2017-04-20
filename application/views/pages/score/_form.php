<?php

echo form_open();
echo form_input(['name' => 'name', 'placeholder' => 'Nom', 'value' => xss_clean($score->name) ?? '']);
echo form_textarea(['name' => 'content', 'placeholder' => 'Texte', 'value' => xss_clean($score->content) ?? '']);
echo $fixedAuthor ? form_hidden('author', xss_clean($score->author->id)) . xss_clean($authors[$score->author->id]) : form_dropdown('author', $authors, xss_clean($score->author->id ?? 0));
echo form_submit('send', xss_clean($submitText));
echo validation_errors();
echo form_close();

 ?>
