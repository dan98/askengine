<div class="card hovercard">
   <div class="avatar">
    <?php
        if($data->gravatar){
            $this->widget('application.extensions.VGGravatarWidget.VGGravatarWidget', 
                array(
                    'email' => $data->email,
                    'hashed' => false, 
                    'default' => 'identicon',                                                
                    'size' => 80,
                    'href' => '/'.$data->id,
                    'rating' => 'PG',
                    'htmlOptions' => array('alt' =>$data->firstname.' '.$data->lastname,  'width'=>"80", 'height'=>"80"),
                )
           );
        }else{
            if($data->image){
                $imghtml=CHtml::image('/avatar-thumb/'.$data->image->image, 'title', array('width'=>80, 'height'=>80));
                echo CHtml::link($imghtml, array('/'.$data->id), array('ajaxlink' => 'link'));
            }else{
                $this->widget('application.extensions.VGGravatarWidget.VGGravatarWidget', 
                    array(
                        'email' => $data->email,
                        'hashed' => false, 
                        'default' => 'identicon',                                                
                        'size' => 80,
                        'href' => '/'.$data->id,
                        'rating' => 'PG',
                        'htmlOptions' => array('alt' =>$data->firstname.' '.$data->lastname,  'width'=>"80", 'height'=>"80"),
                    )
                );
            }
        }
    ?>
   </div>
   <div class="info">
      <div class="title">
         <h3 style="margin:-10px 0 0 0;"><?php echo $data->firstname . ' ' . $data->lastname ?></h3>
      </div>
      <div class="desc"><?php echo $data->about; ?></div>
   </div>
   <div class="bottom">
      <?php
        if ($data->id == Yii::app()->user->id)
            echo CHtml::link(
                '<button class="btn btn-success btn-small" name="yt0" type="button">update</button>',
                $this->createAbsoluteUrl('user/update', array('id' => $data->id)),
                array(
                    'ajaxlink' => 'true'
                )
            );
        else
            if (!Follow::model()->isFollowing($data->id)){
                $this->widget('bootstrap.widgets.TbButton', array(
                        'label' => 'follow',
                        'type' => 'success',
                        'size' => 'small',
                        'htmlOptions' => array(
                            'href' => Yii::app()->createUrl('follow/createFollow/', array('ajax' => 1, 'id' => $data->id)),
                            'class' => 'follow-link'
                        ),
                        'buttonType' => 'button'
                    )
                );
            }else{
                $this->widget('bootstrap.widgets.TbButton', array(
                        'label' => 'unfollow',
                        'type' => 'warning',
                        'size' => 'small',
                        'htmlOptions' => array(
                            'href' => Yii::app()->createUrl('follow/unFollow/', array('ajax' => 1, 'id' => $data->id)),
                            'class' => 'unfollow-link'
                        ),
                        'buttonType' => 'button'
                    )
                );
            }
        ?>
   </div>
</div>