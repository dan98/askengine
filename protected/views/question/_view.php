<div class="view" id="question-view-<?php echo $data->id; ?>">
	<b><?php echo CHtml::encode($data->getAttributeLabel('question_text')); ?>:</b>
	<?php echo CHtml::encode($data->question_text); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('from_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->sender->firstname).' '.CHtml::encode($data->sender->lastname), array('user/view/'.$data->sender->id)); ?>
	<br />
        <?php
            if($data->status == 0 && $data->from_id != Yii::app()->user->id){
                $url = Yii::app()->createAbsoluteUrl('question/ignore/', array('ajax'=>1, 'id'=>$data->id));
                echo CHtml::link('ignore',$url, array('class'=>'ajax-ignore'));
            }else{
                $url = Yii::app()->createAbsoluteUrl('question/delete/', array('ajax'=>1, 'id'=>$data->id));
                echo CHtml::link('delete',$url, array('class'=>'delete-link'));
            }
            
        ?>
         
        <?php
            $url = Yii::app()->createUrl('question/respond/', array('ajax'=>1, 'id'=>$data->id));
            echo CHtml::link('response',$url, array('class'=>'response-link'));    
        ?>
</div>