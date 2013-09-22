<div class="card">
    <div class="card-heading image">
        <div class="card-heading-header" style="display:block;">
           <?php
            if(!isset($profile))
            {
                if($data->sender->gravatar){
                    $this->widget('ext.gravatar.Gravatar', 
                        array(
                            'email' => $data->sender->email,
                            'hashed' => false, 
                            'default' => 'identicon',                                                
                            'size' => 46,
                            'href' => '/'.$data->sender->id,
                            'rating' => 'PG',
                            'htmlOptions' => array('alt' =>$data->sender->firstname.' '.$data->sender->lastname, 'style'=>'float:left;'),
                        )
                    );
                }else{
                    if($data->sender->image)
                    {
                        $imghtml=CHtml::image('/avatar-thumb/'.$data->sender->image->image, $data->sender->firstname.' '.$data->sender->lastname, array('width'=>46, 'height'=>46, 'style'=>'float:left;'));
                        echo CHtml::link($imghtml, array('/'.$data->sender->id), array('ajaxlink' => 'link'));
                    }
                    else
                    {
                        $this->widget('ext.gravatar.Gravatar', 
                            array(
                                'email' => $data->sender->email,
                                'hashed' => false, 
                                'default' => 'identicon',                                                
                                'size' => 46,
                                'href' => '/'.$data->sender->id,
                                'rating' => 'PG',
                                'htmlOptions' => array('alt' =>$data->sender->firstname.' '.$data->sender->lastname, 'style'=>'float:left;'),
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
                        case 0 :echo CHtml::link($data->sender->firstname.' '.$data->sender->lastname, array('/'.$data->sender->id)); break;
                        case 1 :echo 'Anonym'; break;
                        case 2 :echo $data->anonym_custom; break;
                    }
                ?>
                </span>
            </h3>
        </div>
    </div>
    <div class="card-body answer-text wrapword response-wrapper" style="margin-top:5px;">
       
    </div>
    <div class="card-actions" style="padding-bottom:6px; margin-top:7px; ">
        <span style="float:left; color:#999;">
        <?php 
            echo Time::timeAgoInWords($data->created_time); 
        ?>
        </span>
        <span style="float:right;">
            <?php
            if($data->status == 0 && $data->from_id != Yii::app()->user->id)
            {
                $url = Yii::app()->createUrl('question/ignore/', array('ajax'=>1, 'id'=>$data->id));
                echo CHtml::link('ignore',$url, array('class'=>'ignore-link'));
            }
            else
            {
                $url = Yii::app()->createAbsoluteUrl('question/delete/', array('ajax'=>1, 'id'=>$data->id));
                echo CHtml::link('delete',$url, array('class'=>'delete-link'));
            }
            echo ' ';
            $url = Yii::app()->createUrl('question/respond/', array('ajax'=>1, 'id'=>$data->id));
            echo CHtml::link('respond',$url, array('class'=>'response-link'));    
            ?>
        </span>
    </div>
</div>