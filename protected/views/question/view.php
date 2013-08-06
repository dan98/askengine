<?php
/* @var $this QuestionController */
/* @var $model Question */

$this->breadcrumbs=array(
	'Questions'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Question', 'url'=>array('index')),
	array('label'=>'Create Question', 'url'=>array('create')),
	array('label'=>'Respond', 'url'=>array('respond', 'id'=>$model->id)),
	array('label'=>'Delete Question', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Question', 'url'=>array('admin')),
);
?>

<h1>View Question #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'question_text',
		'question_video_id',
		'from_id',
		'to_id',
		'answer_text',
		'answer_video_id',
		'likes_n',
		'anonym',
		'status',
		'created_time',
	),
)); ?>
