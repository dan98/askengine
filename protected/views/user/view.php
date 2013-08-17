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

$me = $model->id == Yii::app()->user->id ? true : false;
?>
<?php
    if($model->image)
    {
        echo CHtml::image('/avatar-thumb/'.$model->image->image); 
    }
    else
    {
        echo CHtml::image('/avatar-thumb/'.'no_avatar.png', 'title', array('width'=>100, 'height'=>100)); 
    }
    if($me)
        echo CHtml::link("new avatar", array('image/avatar'))
?>
<h1>
    <?php echo $model->firstname.' '.$model->lastname ?>
    <small>
    <?php
     if(!$me)
        if(!Follow::model()->isFollowing($model->id)){
            $url = Yii::app()->createAbsoluteUrl('follow/createFollow/', array('ajax'=>1, 'id'=>$model->id));
            echo CHtml::link('follow',$url, array('class'=>'follow-link'));
        }else{
            $url = Yii::app()->createAbsoluteUrl('follow/unFollow/', array('ajax'=>1, 'id'=>$model->id));
            echo CHtml::link('unfollow',$url, array('class'=>'unfollow-link')); 
        }
    ?>
    </small>
</h1>
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
                'followers',
                'following'
	),
)); ?>
<div class="form">
    
    <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'question-form',
            'enableAjaxValidation'=>true,
    )); ?>
            <?php echo $form->errorSummary($q); ?>

            <div class="row">
                <h2><?php echo CHtml::encode($model->title); ?></h2>
                    <?php echo $form->textArea($q,'question_text',array('rows'=>4, 'cols'=>40)); ?>
                    <?php echo $form->error($q,'question_text'); ?>
            </div>
            <div class="row">
                <?php if(!$me){ ?>
                    <?php
                    if($model->anonym_questions == 1)
                        echo $form->dropDownList($q,'anonym', $q->getAnonymOptions()); 
                    else 
                        echo $form->dropDownList($q,'anonym', $q->getAnonymOptions(), array('options'=>array('0'=>array('selected'=>true)), 'disabled'=>true)); 
                    ?>
                <?php } ?>
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
                    <?php echo CHtml::submitButton('Ask now'); ?>
            </div>

    <?php $this->endWidget(); ?>
</div>
<div class="questions">
<?php
$this->widget('zii.widgets.CListView', array(
        'id' => 'QuestionList',
        'dataProvider' => $questions,
        'itemView' => '//question/_feed',
        'viewData' => array('profile'=>true),
        'template' => '{items} {pager}',
        )
    );
?>
</div>
<?php  
  $baseUrl = Yii::app()->baseUrl; 
  $cs = Yii::app()->getClientScript();
  $cs->registerScriptFile($baseUrl.'/js/jquery-ias.min.js');
  $cs->registerScriptFile($baseUrl.'/js/feed.js');
?>