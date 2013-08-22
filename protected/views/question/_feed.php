<div class="view" id="question-view-<?php echo $data->id; ?>">
    
    <span style="float:left">
        <?php
            if(!isset($profile))
            {
                echo CHtml::image($data->receiver->image == null ? '/avatar-thumb/no_avatar.png' : '/avatar-thumb/'.$data->receiver->image->image, $data->receiver->firstname." ".$data->receiver->lastname, array('width'=>50, 'height'=>50));
                echo "<br />";
                echo CHtml::link($data->receiver->firstname." ".$data->receiver->lastname, array('user/view/', $data->receiver->id));
            }
        ?>
    </span>
    
    <span style="float:left">
        - <?php echo CHtml::encode($data->question_text); ?>
        <small>
            <?php 
            switch($data->anonym)
            {
                case 0 :echo CHtml::link('('.$data->sender->firstname." ".$data->sender->lastname.')', array('user/view/', $data->sender->id)); break;
                case 1 :echo '(anonym)'; break;
                case 2 :echo '('.$data->anonym_custom.')'; break;
            }
            ?>
        </small><br>
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
        <span class="like-container">
            <?php
            if(isset($likedcheck)){
                $liked = true;
            }else{
                $liked = Like::model()->likes($data->id);
            }

            if($liked)
            {
                $url = Yii::app()->createAbsoluteUrl('like/dislike/', array('ajax'=>1, 'id'=>$data->id));
                echo CHtml::link('dislike',$url, array('class'=>'dislike-link'));
            }
            else
            {
                $url = Yii::app()->createAbsoluteUrl('like/createlike/', array('ajax'=>1, 'id'=>$data->id));
                echo CHtml::link('like',$url, array('class'=>'like-link'));
            }
            ?>
        </span>
        <span class="like-num">
            <?php 
                echo $data->likes;
            ?>
        </span> likes
    </div>
</div>