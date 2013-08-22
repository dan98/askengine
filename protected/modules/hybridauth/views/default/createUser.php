<h1>Create User</h1>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'user-form',
)); ?>

	<?php echo $form->errorSummary($user); ?>
        
		<?php echo $form->textFieldRow($user,'firstname',array('rows'=>16, 'cols'=>30)); ?>
            
		<?php echo $form->textFieldRow($user,'lastname',array('size'=>16,'maxlength'=>30)); ?>
    
		<?php echo $form->textFieldRow($user,'username',array('size'=>16,'maxlength'=>16)); ?>
    
                <?php echo $form->textAreaRow($user,'about',array('col'=>20,'row'=>4)); ?>
                <br />
		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Register', 'type'=>'primary')); ?>

<?php $this->endWidget(); ?>

</div><!-- form -->