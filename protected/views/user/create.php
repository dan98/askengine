<div class="white-block">
    <div class="page-header"><h1>Register</h1></div>
    
    <div class="row-fluid">  
        
    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array('id'=>'user-create', 'htmlOptions'=>array('style'=>'display: inline;'))); ?>
    
        
        <div class="span4">
            <?php echo $form->errorSummary($model); ?>
            <?php echo $form->textFieldRow($model,'firstname'); ?>

            <?php echo $form->textFieldRow($model,'lastname'); ?>
            
            <?php echo $form->textFieldRow($model,'username'); ?>
            
            
            <?php echo $form->textAreaRow($model,'about',array('rows'=>6, 'cols'=>30)); ?>
            <?php //echo $form->textFieldRow($model,'residence'); ?>

            <?php //echo $form->textFieldRow($model,'language',array('size'=>10,'maxlength'=>10)); ?>

            <?php //echo $form->textFieldRow($model,'website',array('size'=>30,'maxlength'=>256)); ?>
            
            <?php //echo $form->labelEx($model,'birthday'); ?>
            <?php //echo $form->dropDownList($model, 'day', $model->getAllDays(), array('options' => array($model->day=>array('selected'=>true)), 'style'=>'width:auto;')); ?>
            <?php //echo $form->dropDownList($model, 'month', $model->getAllMonths(), array('options' => array($model->month=>array('selected'=>true)), 'style'=>'width:auto;')); ?>
            <?php //echo $form->dropDownList($model, 'year', $model->getAllYears(), array('options' => array($model->year=>array('selected'=>true)), 'style'=>'width:auto;')); ?>
            <?php //echo $form->error($model,'birthday'); ?>
        </div>
        <div class="span4">
            <?php echo $form->textFieldRow($model,'email'); ?>
               <?php echo $form->label($model,'Password'); ?>
            <?php echo $form->passwordField($model,'password',array('maxlength'=>40)); ?>
            <?php echo $form->passwordField($model,'repeat_password',array('maxlength'=>40)); ?>
            <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'label' => 'Continue', 'type' => 'primary', 'htmlOptions'=>array('style'=>'margin-bottom:20px;'))) ?>
        
        </div>
        <div class="span4">
            <label for="image_file">Register with: </label>
            <?php $this->widget('application.modules.hybridauth.widgets.renderProviders'); ?>
         </div>
        <?php $this->endWidget(); ?>
    </div>
</div>