<div class="white-block">
    <h1>Create User</h1>
    <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
    <div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id'=>'user-form',
            'enableAjaxValidation'=>true,
            'clientOptions' => array(
             'validateOnSubmit' => true,
             'validateOnChange' => true, // allow client validation for every field
            ) 
    )); ?>

            <p class="note">Fields with <span class="required">*</span> are required.</p>

            <?php echo $form->errorSummary($model); ?>
            <?php echo $form->label($model,'firstname'); ?>
            <?php echo $form->textField($model,'firstname',array('rows'=>16, 'cols'=>30)); ?>
            <?php echo $form->error($model,'firstname',array('rows'=>16, 'cols'=>30)); ?>
            <?php echo $form->label($model,'lastname'); ?>
            <?php echo $form->textField($model,'lastname',array('rows'=>16, 'cols'=>30)); ?>
            <?php echo $form->error($model,'lastname',array('rows'=>16, 'cols'=>30)); ?>
            <?php echo $form->label($model,'email'); ?>
            <?php echo $form->textField($model,'email',array('size'=>30,'maxlength'=>256)); ?>
            <?php echo $form->error($model,'email',array('size'=>30,'maxlength'=>256)); ?>
            <?php echo $form->label($model,'Password'); ?>
            <?php echo $form->passwordField($model,'password',array('maxlength'=>40)); ?>
            <?php echo $form->passwordField($model,'repeat_password',array('maxlength'=>40)); ?>
            <?php echo $form->label($model,'username'); ?>
            <?php echo $form->textField($model,'username',array('size'=>16,'maxlength'=>16)); ?>
            <div class="submit">
           <?php echo CHtml::submitButton('Register'); ?> </div>

    <?php $this->endWidget(); ?>

    </div><!-- form -->
</div>