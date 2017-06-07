<?php echo form_open() ?>
<?php
if ($disabled)
{
    echo form_hidden('name', xss_clean($chord->name));
    echo xss_clean($chord->name);
}
else
{
    echo form_input(['name' => 'name', 'placeholder' => 'Nom', 'value' => xss_clean($chord->name) ?? '']);
}
?>
<?php echo form_input(['name' => 'fingers', 'placeholder' => 'Doigts', 'value' => xss_clean($chord->fingers) ?? '', 'maxlength' => 6]) ?>
<?php echo form_submit('submit', xss_clean($submitText)) ?>
<?php echo validation_errors() ?>
<?php echo form_close() ?>
