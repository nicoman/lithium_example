<?php if($saved): ?>
<h4>User <?=$data['username'] ?> created</h4>
<?php endif; ?>
<?=$this->form->create($user); ?>
    <?=$this->form->field('username'); ?>
    <?=$this->form->field('password', array('type'=>'password')); ?>
    <?=$this->form->submit('Add User'); ?>
<?=$this->form->end(); ?>
