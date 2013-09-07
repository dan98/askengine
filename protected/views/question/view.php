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
