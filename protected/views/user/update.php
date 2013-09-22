<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jcrop.css" />
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.jcrop.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/avatar.js"></script>

<div class="white-block">
    <div class="page-header"><h1>Settings</h1></div>
    
    <div class="row-fluid">  
        
    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array('id'=>'user-settings', 'htmlOptions'=>array('style'=>'display: inline;'))); ?>
    
        
        <div class="span4">
            <?php echo $form->errorSummary($model); ?>
            <?php echo $form->textFieldRow($model,'firstname'); ?>

            <?php echo $form->textFieldRow($model,'lastname'); ?>
            
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
            
            <?php echo $form->textFieldRow($model,'title'); ?>

            <?php echo $form->checkBoxRow($model,'anonym_questions'); ?>

            <?php echo $form->checkBoxRow($model,'gravatar'); ?>

            <script>
                $(document).ready(function(){
                    $('#newpassword').click(function(){
                        $('#newpasswordrow').html(
                        '<label for="User_password">New password</label> <div><?php echo $form->passwordField($model,'password',array('maxlength'=>40)); ?><?php echo $form->passwordField($model,'repeat_password',array('maxlength'=>40)); ?></div><?php echo $form->error($model,'password'); ?>'
                        );
                    });
                });
            </script>

            <a id="newpassword" style="cursor: pointer">Create new password</a>
            <div id="newpasswordrow"></div>
            <br />
            <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'label' => 'Salvează', 'type' => 'primary', 'htmlOptions'=>array('style'=>'margin-bottom:20px;'))) ?>
        </div>
        <?php $this->endWidget(); ?>
        
        <form id="image-form" enctype="multipart/form-data" method="post" action="<?php echo Yii::app()->createUrl('image/avatar') ?>" onsubmit="return checkForm()">
            <div class="span4">
                <label for="image_file">New image</label>      

                     <input type="hidden" id="x1" name="Image[x1]" />
                     <input type="hidden" id="y1" name="Image[y1]" />
                     <input type="hidden" id="x2" name="Image[x2]" />
                     <input type="hidden" id="y2" name="Image[y2]" />
                     <input id="image_file" onchange="fileSelectHandler()" name="Image[image]" type="file">
                     <div class="error"></div>
                         <img id="preview" />
                             <input type="hidden" id="filesize" name="Image[filesize]" />
                             <input type="hidden" id="filetype" name="Image[filetype]" />
                             <input type="hidden" id="filedim" name="Image[filedim]" />
                             <input type="hidden" id="w" name="Image[w]" />
                             <input type="hidden" id="h" name="Image[h]" />
                             <br />
                    <button type="submit" value="Upload" class="btn btn-success">Upload</button>
                
            </div>
        </form>
    </div>
</div>