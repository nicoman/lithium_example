<?php if($saved): ?>
<h4>Data saved successfully!</h4>
<?php endif; ?>
<!-- Customize the form error messages -->
<?php

$this->form->config(
    array(
        'templates' => array(
            'error' => '<div style="color: red">{:content}</div>'
        )
    )
);

?>
<!-- Generate the opening form tag -->
<?=$this->form->create($my_post); ?>
    <!-- Generate a text field for "title" -->
    <?=$this->form->field('title'); ?>
    <!-- Generate a text area field for body content -->
    <?=$this->form->field('body',array('type'=>'textarea')); ?>
    <!-- Generate the submit button -->
    <?=$this->form->submit('Add Post'); ?>
<!-- Generate the closing form tag -->
<?=$this->form->end(); ?>
