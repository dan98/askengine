<div class="white-block">
    <div class="page-header"><h1>Register</h1></div>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array('id'=>'user-settings', 'htmlOptions'=>array('style'=>'display: inline;'))); ?>
<?php echo $form->errorSummary($user); ?>
    <div class="row-fluid">  
        <div class="span6">
            <?php echo $form->textFieldRow($user,'firstname'); ?>
            <?php echo $form->textFieldRow($user,'lastname'); ?>
            <?php echo $form->textFieldRow($user,'username'); ?>
        </div>
        <div class="span6">
            <?php echo $form->textAreaRow($user,'about',array('rows'=>8, 'cols'=>30)); ?>
        </div>
    </div>   
<br />
<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'size'=>'large', 'label' => 'Continue', 'type' => 'primary', 'htmlOptions'=>array('style'=>'margin-bottom:20px;width:100%'))) ?>
<?php $this->endWidget(); ?>