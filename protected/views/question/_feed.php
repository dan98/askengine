<div class="card" id="question-view-<?php echo $data->id; ?>">
    <div class="card-heading image">
        <div class="card-heading-header" style="display:block;">
           <?php
            if(!isset($profile))
            {
                if($data->receiver->gravatar){
                    $this->widget('application.extensions.VGGravatarWidget.VGGravatarWidget', 
                        array(
                            'email' => $data->receiver->email,
                            'hashed' => false, 
                            'default' => 'identicon',                                                
                            'size' => 46,
                            'href' => '/'.$data->receiver->id,
                            'rating' => 'PG',
                            'htmlOptions' => array('alt' =>$data->receiver->firstname.' '.$data->receiver->lastname, 'style'=>'float:left;'),
                        )
                    );
                }else{
                    if($data->receiver->image)
                    {
                        $imghtml=CHtml::image('/avatar-thumb/'.$data->receiver->image->image, 'title', array('width'=>46, 'height'=>46, 'style'=>'float:left;'));
                        echo CHtml::link($imghtml, array('/'.$data->receiver->id), array('ajaxlink' => 'link'));
                    }
                    else
                    {
                        $this->widget('application.extensions.VGGravatarWidget.VGGravatarWidget', 
                            array(
                                'email' => $data->receiver->email,
                                'hashed' => false, 
                                'default' => 'identicon',                                                
                                'size' => 46,
                                'href' => '/'.$data->receiver->id,
                                'rating' => 'PG',
                                'htmlOptions' => array('alt' =>$data->receiver->firstname.' '.$data->receiver->lastname, 'style'=>'float:left;'),
                            )
                        );
                    }
                }
            }
        ?>
            <h3><?php echo CHtml::encode($data->question_text); ?>
                <span style="white-space:nowrap; margin-left: 6px;">
                <?php 
                    switch($data->anonym)
                    {
                        case 0 :echo CHtml::link($data->sender->firstname." ".$data->sender->lastname, array('/'.$data->sender->id)); break;
                        case 1 :echo 'anonym'; break;
                        case 2 :echo $data->anonym_custom; break;
                    }
                ?>
                </span>
            </h3>
        </div>
    </div>
    <div class="card-body answer-text wrapword" style="margin-top:5px;">
        <p><?php echo CHtml::encode($data->answer_text); ?></p>
    </div>
    <?php 
        if($data->image)
        {
    ?>
        <div class="card-media">
            <?php     echo CHtml::image("/images/".$data->image, '',array('style'=>'width:100%;max-height:none;', 'onload'=>'ratio(this.id)', 'id'=>'qimage-'.$data->id)); ?>
        </div>
    <?php
        }
    ?>
    <div class="card-actions" style="padding-bottom:4px; ">
        <span style="float:left; color:#999;">
        <?php 
            echo Time::timeAgoInWords($data->updated_time); 
        ?>
        -
        <?php 
            switch($data->anonym)
            {
                case 0 :echo CHtml::link($data->sender->firstname." ".$data->sender->lastname, array('/'.$data->sender->id)); break;
                case 1 :echo 'anonym'; break;
                case 2 :echo $data->anonym_custom; break;
            }
        ?>
        </span>
        <span style="float:right;">
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
            <span class="like-container" style="color: #999;">
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
        <span class="like-num" style="color: #999;">
            <?php 
                echo $data->likes;
            ?> likes
        </span> 
        </span>
    </div>
</div>