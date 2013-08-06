<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Create User', 'url'=>array('create')),
	array('label'=>'Update User', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete User', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage User', 'url'=>array('admin')),
);
?>

<h1>View User #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'email',
		'password',
		'firstname',
		'lastname',
		'residence',
		'language',
		'about',
		'website',
		'title',
		'username',
		'birthday',
		'answers_n',
		'likes_n',
		'followers_n',
		'created_time',
		'updated_time',
		'last_login_time',
		'status',
		'image_id',
		'anonym_questions',
	),
)); ?>
<div class="form">
    <h2>Ask a question:</h2>
    <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'question-form',
            'enableAjaxValidation'=>false,
    )); ?>

            <?php echo $form->errorSummary($q); ?>

            <div class="row">
                <?php echo $form->labelEx($q,'question_text'); ?>
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