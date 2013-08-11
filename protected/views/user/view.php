<?php
/* @var $this UserController */
/* @var $model User */


$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Create User', 'url'=>array('create')),
	array('label'=>'Update User', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete User', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage User', 'url'=>array('admin')),
);
?>
<?php echo CHtml::image("/avatar-thumb/".$model->image->image); ?>
<h1><?php echo $model->firstname.' '.$model->lastname ?></h1>


<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'email',
		'firstname',
		'lastname',
		'about',
		'website',
		'title',
		'username',
		'birthday',
		'answers_n',
		'likes_n',
		'followers_n',
		'last_login_time',
		'image_id',
	),
)); ?>
<div class="form">
    
    <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'question-form',
            'enableAjaxValidation'=>false,
    )); ?>
            <?php echo $form->errorSummary($q); ?>

            <div class="row">
                <h2><?php echo CHtml::encode($model->title); ?></h2>
                    <?php echo $form->textArea($q,'question_text',array('rows'=>4, 'cols'=>40)); ?>
                    <?php echo $form->error($q,'question_text'); ?>
            </div>
            <div class="row">
                    <?php echo $form->dropDownList($q,'anonym', $q->getAnonymOptions()); ?>
                    <?php echo $form->error($q,'anonym'); ?>
            </div>
            <div id='custom_anonym'>
            </div>
            <script>
            
            $("#Question_anonym")
              .change(function () {
                if($('#Question_anonym option:selected').attr('value') == 2){
                    $('#custom_anonym').html('<?php echo $form->textField($q,'anonym_custom'); ?>');
                }else{
                    $('#custom_anonym').html('');
                }
              })
            </script>
            <div class="row buttons">
                    <?php echo $form->hiddenField($q,'to_id',array('value'=>$model->id)); ?>
                    <?php echo CHtml::submitButton($q->isNewRecord ? 'Create' : 'Save'); ?>
            </div>

    <?php $this->endWidget(); ?>
</div>
<div class="questions">
<?php
$this->widget('zii.widgets.CListView', array(
       'id' => 'QuestionList',
       'dataProvider' => $questions,
       'itemView' => '//question/_view',
       'template' => '{items} {pager}',
       'pager' => array(
                    'class' => 'ext.infiniteScroll.IasPager', 
                    'rowSelector'=>'.row', 
                    'listViewId' => 'QuestionList', 
                    'header' => '',
                    'loaderText'=>'Loading...',
                    'options' => array('history' => true, 'triggerPageTreshold' => 3, 'trigger'=>'Load more'),

           )
            )
       );
?>
</div>
<?php  
  $baseUrl = Yii::app()->baseUrl; 
  $cs = Yii::app()->getClientScript();
  $cs->registerScriptFile($baseUrl.'/js/jquery-ias.min.js');
?>
<script>
    
jQuery.ias({'history':true,'triggerPageTreshold':3,'trigger':'Загрузить еще','container':'#QuestionList > .items','item':'.view','pagination':'#QuestionList .pager','next':'#QuestionList .next:not(.disabled):not(.hidden) a','loader':'Загрузка'});

function refreshbinds(){
   $('.hide-link').unbind('click');
   $('.hide-link').bind('click', hideandshowlink);
   $('.show-link').unbind('click');
   $('.show-link').bind('click', hideandshowlink);
}
hideandshowlink = function(event){
    event.preventDefault();
    var url = $(this).attr('href');
    $.ajax({
        type:'POST',
        url: url,
        context: this,
        beforeSend:function(){
             $(this).parent().parent().hide('slow');
        }
    });
};


refreshbinds();
</script>