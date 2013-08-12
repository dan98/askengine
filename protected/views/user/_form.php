<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'firstname'); ?>
		<?php echo $form->textField($model,'firstname',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'firstname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lastname'); ?>
		<?php echo $form->textField($model,'lastname',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'lastname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'residence'); ?>
		<?php echo $form->textField($model,'residence',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'residence'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'language'); ?>
		<?php echo $form->textField($model,'language',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'language'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'about'); ?>
		<?php echo $form->textArea($model,'about',array('rows'=>6, 'cols'=>30)); ?>
		<?php echo $form->error($model,'about'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'website'); ?>
		<?php echo $form->textField($model,'website',array('size'=>30,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'website'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'anonym_questions'); ?>
		<?php echo $form->checkBox($model,'anonym_questions'); ?>
		<?php echo $form->error($model,'anonym_questions'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'birthday'); ?>
		<?php echo $form->dropDownList($model, 'day', $model->getAllDays(), array('options' => array($model->day=>array('selected'=>true)))); ?>
                <?php echo $form->dropDownList($model, 'month', $model->getAllMonths(), array('options' => array($model->month=>array('selected'=>true)))); ?>
                <?php echo $form->dropDownList($model, 'year', $model->getAllYears(), array('options' => array($model->year=>array('selected'=>true)))); ?>
		<?php echo $form->error($model,'birthday'); ?>
	</div>
        <script>
        $(document).ready(function(){
            $('#newpasswordrow').hide();
            $('#newpassword').click(function(){
                $('#newpasswordrow').show();
            });
        });
        </script>
        <a id="newpassword" style="cursor: pointer">Set new password</a>
        <div class="row" id="newpasswordrow">
            New password
            <div>
                <?php echo $form->passwordField($model,'password',array('maxlength'=>40)); ?>
                <?php echo $form->passwordField($model,'repeat_password',array('maxlength'=>40)); ?>
            </div>
            <?php echo $form->error($model,'password'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->