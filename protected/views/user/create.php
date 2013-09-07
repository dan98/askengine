<div class="card" style="padding-top:0; margin-bottom:0px;">
    <h3 class="card-heading simple">Register</h3>
</div>
<div class="white-block">
    <div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array('id'=>'user-form')); ?>

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