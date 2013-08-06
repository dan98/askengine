<?php
/* @var $this QuestionController */
/* @var $model Question */

$this->breadcrumbs=array(
	'Questions'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Question', 'url'=>array('index')),
	array('label'=>'Create Question', 'url'=>array('create')),
	array('label'=>'View Question', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Question', 'url'=>array('admin')),
);
?>

<h1>Answer Question <?php echo $model->id; ?></h1>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'question-form',
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">- <?php echo $model->question_text; ?></p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'answer_text'); ?>
		<?php echo $form->textArea($model,'answer_text',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'answer_text'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div>