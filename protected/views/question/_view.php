<div class="view" id="question-view-<?php echo $data->id; ?>">
	 - <?php echo CHtml::encode($data->question_text); ?><small> <?php echo CHtml::link('('.$data->sender->firstname." ".$data->sender->lastname.')', array('user/view', $data->sender->id)) ?></small><br>
	 - <?php echo CHtml::encode($data->answer_text); ?><br>
         <div align="right">
             <small><?php echo Time::timeAgoInWords($data->updated_time); ?></small>
             <?php
                if($data->from_id == Yii::app()->user->id)
                {
                    if($data->hide == 0)
                    {
                        $url = Yii::app()->createAbsoluteUrl('question/hide/', array('ajax'=>1, 'id'=>$data->id));
                        echo CHtml::link('hide',$url, array('class'=>'hide-link'));
                    }
                    else
                    {
                        $url = Yii::app()->createAbsoluteUrl('question/show/', array('ajax'=>1, 'id'=>$data->id));
                        echo CHtml::link('show',$url, array('class'=>'show-link'));
                    }
                }
            ?>
         </div>
</div>