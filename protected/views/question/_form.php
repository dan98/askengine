<?php
/* @var $this QuestionController */
/* @var $model Question */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
        'action'=>array('question/create'),
	'id'=>'question-form',
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'question_text'); ?>
		<?php echo $form->textArea($model,'question_text',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'question_text'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'anonym'); ?>
		<?php echo $form->textField($model,'anonym'); ?>
		<?php echo $form->error($model,'anonym'); ?>
	</div>

	<div class="row buttons">
            <?php echo $form->hiddenField($model,'to_id',array('value'=>2)); ?>
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->