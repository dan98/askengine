<?php
/* @var $this QuestionController */
/* @var $model Question */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'question_text'); ?>
		<?php echo $form->textArea($model,'question_text',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'question_video_id'); ?>
		<?php echo $form->textField($model,'question_video_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'from_id'); ?>
		<?php echo $form->textField($model,'from_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'to_id'); ?>
		<?php echo $form->textField($model,'to_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'answer_text'); ?>
		<?php echo $form->textArea($model,'answer_text',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'answer_video_id'); ?>
		<?php echo $form->textField($model,'answer_video_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'likes_n'); ?>
		<?php echo $form->textField($model,'likes_n'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'anonym'); ?>
		<?php echo $form->textField($model,'anonym'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'created_time'); ?>
		<?php echo $form->textField($model,'created_time'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->