<?php
/* @var $this QuestionController */
/* @var $data Question */
?>

<div class="view" id="question-view-<?php echo $data->id; ?>">
	<b><?php echo CHtml::encode($data->getAttributeLabel('question_text')); ?>:</b>
	<?php echo CHtml::encode($data->question_text); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('from_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->sender->firstname).' '.CHtml::encode($data->sender->lastname), array('user/view/'.$data->sender->id)); ?>
	<br />
        <?php
            if($data->status == 0 && $data->from_id != Yii::app()->user->id){
                $url = Yii::app()->createAbsoluteUrl('question/ignore/', array('id'=>$data->id, 'ajax'=>true));
                echo CHtml::ajaxLink('ignore',$url,array(
                    'type'=>'POST',
                    'success' => "function( data )
                    {
                      $('#question-view-".$data->id."').hide('slow');
                    }",
                    'beforeSend' => "function( data )
                    {
                      $('#question-view-".$data->id."').html('ignoring ...');
                    }",
                ));
            }else{
                $url = Yii::app()->createAbsoluteUrl('question/delete/', array('id'=>$data->id, 'ajax'=>true));
                echo CHtml::ajaxLink('delete',$url,array(
                    'type'=>'POST',
                    'success' => "function( data )
                    {
                      $('#question-view-".$data->id."').hide('slow');
                    }",
                    'beforeSend' => "function( data )
                    {
                      $('#question-view-".$data->id."').html('deleting ...');
                    }",
                ));
            }
            ?>
</div>