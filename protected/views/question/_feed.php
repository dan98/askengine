<div class="view" id="question-view-<?php echo $data->id; ?>">
        <span style="float:left"><?php echo CHtml::image($data->receiver->image == null ? '/avatar-thumb/no_avatar.png' : '/avatar-thumb/'.$data->receiver->image->image, $data->receiver->firstname." ".$data->receiver->lastname, array('width'=>50, 'height'=>50)) ?></span>
	 <span style="float:left">- <?php echo CHtml::encode($data->question_text); ?><small> <?php echo CHtml::link('('.$data->sender->firstname." ".$data->sender->lastname.')', array('user/view', $data->sender->id)) ?></small><br>
	 - <?php echo CHtml::encode($data->answer_text); ?><br />
         <?php 
            if($data->image)
            {
                echo CHtml::image("/images-thumb/".$data->image);
            }
         ?>
        </span>
         <div align="right" style="clear:both">
             <small><?php echo Time::timeAgoInWords($data->updated_time); ?></small>
             <?php
                if($data->to_id == Yii::app()->user->id)
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
            <?php
                if($data->to_id != Yii::app()->user->id)
                {
                    if(Like::model()->likes($data->id))
                    {
                        $url = Yii::app()->createAbsoluteUrl('like/dislike/', array('ajax'=>1, 'id'=>$data->id));
                        echo CHtml::link('dislike',$url, array('class'=>'dislike-link'));
                    }
                    else
                    {
                        $url = Yii::app()->createAbsoluteUrl('like/like/', array('ajax'=>1, 'id'=>$data->id));
                        echo CHtml::link('like',$url, array('class'=>'like-link'));
                    }
                }
            ?>
            <?php 
                echo $data->likes_n.' likes';
            ?>
         </div>
</div>