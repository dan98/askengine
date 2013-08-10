<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Manage User', 'url'=>array('admin')),
);
?>

<h1>Create User</h1>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($user); ?>
        
	<div class="row">
		<?php echo $form->labelEx($user,'firstname'); ?>
		<?php echo $form->textField($user,'firstname',array('rows'=>16, 'cols'=>30)); ?>
		<?php echo $form->error($user,'firstname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($user,'lastname'); ?>
		<?php echo $form->textField($user,'lastname',array('size'=>16,'maxlength'=>30)); ?>
		<?php echo $form->error($user,'lastname'); ?>
	</div>
        
	<div class="row">
		<?php echo $form->labelEx($user,'email'); ?>
		<?php echo $form->textField($user,'email',array('size'=>30,'maxlength'=>256)); ?>
		<?php echo $form->error($user,'email'); ?>
	</div>
        
	<div class="row">
		<?php echo $form->labelEx($user,'username'); ?>
		<?php echo $form->textField($user,'username',array('size'=>16,'maxlength'=>16)); ?>
		<?php echo $form->error($user,'username'); ?>
        </div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($user->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->