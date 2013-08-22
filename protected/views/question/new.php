<?php  
    $baseUrl = Yii::app()->baseUrl; 
    $cs = Yii::app()->getClientScript();
    $cs->registerScriptFile($baseUrl.'/js/jquery-ias.min.js');
    $cs->registerScriptFile($baseUrl.'/js/ajax.js');
    $cs->registerScriptFile($baseUrl.'/js/jquery.form.min.js');
?>
<div class="page-header">
  <h1>New</h1><a id="selfform-trigger" style="cursor: pointer;">personal</a> 
</div>
    <div id="selfform">
        <?php $form=$this->beginWidget('CActiveForm', array(
                'id'=>'questiona',
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data',
        )
        )); ?>
                <?php echo $form->errorSummary($q); ?>

                <div style="float:left;"></div>
                        - <?php echo $form->textArea($q,'question_text',array('rows'=>3, 'cols'=>20)); ?>
                        <?php echo $form->error($q,'question_text'); ?>
                        -  <?php echo $form->textArea($q,'answer_text',array('rows'=>3, 'cols'=>20)); ?>
                    <?php echo $form->error($q,'answer_text'); ?>
                    <?php echo $form->dropDownList($q,'anonym', $q->getAnonymOptions());?>
                    <?php echo $form->fileField($q,'image', array('size'=>10));?>
                    <?php echo $form->checkBox($q,'hide');?>
        
                <span id='custom_anonym'>
                </span>
        
                <script>
                $("#Question_anonym")
                .change(function(){
                    if($('#Question_anonym option:selected').attr('value') == 2){
                        $('#custom_anonym').html('<?php echo $form->textField($q,'anonym_custom'); ?>');
                    }else{
                        $('#custom_anonym').html('');
                    }
                });
                
                if($('#Question_anonym option:selected').attr('value') == 2){
                    $('#custom_anonym').html('<?php echo $form->textField($q,'anonym_custom'); ?>');
                }
                </script>
                <div class="row buttons">
                    <?php echo CHtml::submitButton('Save'); ?>
                </div>

        <?php $this->endWidget(); ?>
    </div>
<div style="clear: both;"></div>
<script>
$('#selfform').hide();
$('#selfform-trigger').click(function(){
    if($('#selfform').is(":visible"))
        $('#selfform').hide();
    else
        $('#selfform').show("fast");
});

</script>
<?php
$this->widget('zii.widgets.CListView', array(
        'id' => 'QuestionList',
        'dataProvider' => $dataProvider,
        'itemView' => '_new',
        'template' => '{items}<div style="clear: both;"></div>{pager}',
        'pager' => array(
            'class' => 'ext.infiniteScroll.IasPager', 
            'rowSelector'=>'.view', 
            'listViewId' => 'QuestionList',
            'loaderText'=>'Loading...',
            'header' => '',
            'options' => array('history' => true, 'triggerPageTreshold' => 5, 'trigger'=>'Load more'),
        )
    )
);
?>