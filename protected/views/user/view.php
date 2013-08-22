<?php
$me = $model->id == Yii::app()->user->id ? true : false;
?>
    <div class="view-image" align='right'>
        <?php
            if($model->gravatar)
                $this->widget('application.extensions.VGGravatarWidget.VGGravatarWidget', 
                    array(
                        'email' => $model->email,
                        'hashed' => false, 
                        'default' => 'identicon',                                                
                        'size' => 80,
                        'rating' => 'PG',
                        'htmlOptions' => array('alt' =>$model->firstname.' '.$model->lastname),
                    )
                );
            else
                if($model->image)
                {
                    echo CHtml::image('/avatar-thumb/'.$model->image->image); 
                }
                else
                {
                    echo CHtml::image('/avatar-thumb/'.'no_avatar.png', 'title', array('width'=>80, 'height'=>80)); 
                }
            //if($me)
            //   echo CHtml::link("new avatar", array('image/avatar'))
        ?>
    </div>
    <div class="view-user">
        <h3 style='margin:0px;'><?php echo $model->firstname.' '.$model->lastname ?></h3>
            <small><?php echo $model->about; ?></small>
    </div>
    <div class="view-buttons">
        <?php
         if(!$me)
            if(!Follow::model()->isFollowing($model->id)){
                $url = Yii::app()->createAbsoluteUrl('follow/createFollow/', array('ajax'=>1, 'id'=>$model->id));
                $this->widget('bootstrap.widgets.TbButton', array(
                    'label'=>'follow',
                    'type'=>'primary',
                    'size'=>'small',
                    'htmlOptions'=>array(
                        'href'=>$url,
                        'class'=>'follow-link'
                    ),
                    'buttonType'=>'button'
                ));
            }else{
                $url = Yii::app()->createAbsoluteUrl('follow/unFollow/', array('ajax'=>1, 'id'=>$model->id)); 
                $this->widget('bootstrap.widgets.TbButton', array(
                    'label'=>'unfollow',
                    'type'=>'danger',
                    'size'=>'small',
                    'htmlOptions'=>array(
                        'href'=>$url,
                        'class'=>'unfollow-link'
                    ),
                    'buttonType'=>'button'
                ));
            }
            else 
            echo CHtml::link(
                '<button class="btn btn-success btn-small" name="yt0" type="button">update</button>',
                $this->createUrl('user/update', array('id'=>$model->id)),
                array(
                    'ajaxlink'=>'true',
                )
            );
        ?>
    </div>
        <?php $this->widget('bootstrap.widgets.TbMenu', array(
            'type'=>'pills', // '', 'tabs', 'pills' (or 'list')
            'stacked'=>false, // whether this is a stacked menu
            'htmlOptions'=>array('class'=>'view-tabs'),
            'items'=>array(
                array('label'=>'Feed', 'url'=>$this->createUrl('user/view', array('id'=>$model->id)), 'active'=>true, 'linkOptions'=>array('ajaxlink'=>true)),
            ),
        )); ?>

<?php if(!$me){ ?>

        <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                'id'=>'question-form'
        )); ?>
                <?php echo $form->errorSummary($q); ?>
                <p>
                  <h4><?php echo $model->title; ?></h4>
                </p>
                        
                        <?php
                            echo $form->textAreaRow($q,'question_text',array('rows'=>4, 'cols'=>40));
                        ?>
                
                        <?php
                            if($model->anonym_questions == 1)
                                echo $form->dropDownList($q,'anonym', $q->getAnonymOptions()); 
                            else 
                                echo $form->dropDownList($q,'anonym', $q->getAnonymOptions(), array('options'=>array('0'=>array('selected'=>true)), 'disabled'=>true)); 
                        ?>
        
                <div id='custom_anonym'>
                </div>
        
                <script>
                    $("#Question_anonym")
                    .change(function(){
                        if($('#Question_anonym option:selected').attr('value') == 2){
                            $('#custom_anonym').html('<?php echo $form->textFieldRow($q,'anonym_custom'); ?>');
                        }else{
                            $('#custom_anonym').html('');
                        }
                    });

                    if($('#Question_anonym option:selected').attr('value') == 2){
                        $('#custom_anonym').html('<?php echo $form->textField($q,'anonym_custom'); ?>');
                    }
                </script>
                    <?php echo $form->hiddenField($q,'to_id',array('value'=>$model->id)); ?>
                    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Ask', 'type'=>'info')); ?>

        <?php $this->endWidget(); ?>
<?php } ?>
<?php  
  $baseUrl = Yii::app()->baseUrl; 
  $cs = Yii::app()->getClientScript();
  $cs->registerScriptFile($baseUrl.'/js/jquery-ias.min.js');
  $cs->registerScriptFile($baseUrl.'/js/ajax.js');
  
?>
<?php
$this->widget('zii.widgets.CListView',array(
        'id' => 'QuestionList',
        'dataProvider' => $questions,
        'itemView' => '//question/_feed',
        'viewData' => array('profile'=>true),
        'template' => '{items} {pager}',
        'pager' => array(
            'class' => 'ext.infiniteScroll.IasPager', 
            'rowSelector'=>'.view', 
            'listViewId' => 'QuestionList',
            'header' => '',
            'loaderText'=>'Loading...',
            'options' => array('history' => true, 'triggerPageTreshold' => 5, 'trigger'=>'Load more'),
        )
    )
);
?>