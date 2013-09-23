<?php
    $me = $model->id == Yii::app()->user->id ? true : false;
?>
<div class="white-block">
    <div class="view-image" align='right'>
        <?php
            if($model->gravatar){
                $this->widget('ext.gravatar.Gravatar', 
                    array(
                        'email' => $model->email,
                        'hashed' => false, 
                        'default' => 'identicon',                                                
                        'size' => 80,
                        'href' => '/'.$model->id,
                        'rating' => 'PG',
                        'htmlOptions' => array('alt' => $model->firstname.' '.$model->lastname, 'style'=>'float:left;'),
                    )
               );
            }else{
                if($model->image){
                    $imghtml=CHtml::image('/avatar-thumb/'.$model->image->image, $model->firstname.' '.$model->lastname, array('width'=>80, 'height'=>80));
                    echo CHtml::link($imghtml, array('/'.$model->id), array('ajaxlink' => 'link'));
                }else{
                    $this->widget('ext.gravatar.Gravatar', 
                        array(
                            'email' => $model->email,
                            'hashed' => false, 
                            'default' => 'identicon',                                                
                            'size' => 80,
                            'href' => '/'.$model->id,
                            'rating' => 'PG',
                            'htmlOptions' => array('alt' =>$model->firstname.' '.$model->lastname, 'style'=>'float:left;'),
                        )
                    );
                }
            }
        ?>
    </div>
    <div class="view-user">
        <h3><?php echo $model->firstname . ' ' . $model->lastname ?></h3>
        <small><?php echo $model->about; ?></small>
    </div>
    <div class="view-buttons">
        <?php
        if ($me)
            echo CHtml::link(
                '<button class="btn btn-success btn-small" name="yt0" type="button">settings</button>',
                $this->createAbsoluteUrl('user/update', array('id' => $model->id)),
                array('ajaxlink' => 'true')
            );
        else
            if (!Follow::model()->isFollowing($model->id)){
                $this->widget('bootstrap.widgets.TbButton', array(
                        'label' => 'follow',
                        'type' => 'success',
                        'size' => 'small',
                        'htmlOptions' => array(
                            'href' => Yii::app()->createUrl('follow/createFollow/', array('ajax' => 1, 'id' => $model->id)),
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
                            'href' => Yii::app()->createUrl('follow/unFollow/', array('ajax' => 1, 'id' => $model->id)),
                            'class' => 'unfollow-link'
                        ),
                        'buttonType' => 'button'
                    )
                );
            }
        ?>
    </div>
    <div class="clear"></div>
</div>


<div class="row-fluid">
    <div class="span8">
        <div class="card ask-card">
            <h3 class="card-heading simple">
                <?php
                    echo !empty($model->title) ? $model->title : 'Ask me now';
                ?>
            </h3>
            <div class="card-body">
                <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array('id' => 'question-form', 'htmlOptions'=>array('class' => 'ask-user-form')))?>
                    
                    <?php echo $form->errorSummary($q) ?>
                
                    <?php echo $form->textArea($q, 'question_text', array('rows' => 1, 'cols' => 40)) ?>
                    <script>
                        $('#Question_question_text').click(function() {
                             $('.display').filter(function() {
                                return $(this).css('display') == 'none';
                            }).show();
                            $(this).attr('rows', 4);
                            UserAsk();
                        });
                    </script>
                    
                    <div style="display:none;" class="display">
                        
                        <?php
                            $options = $model->anonym_questions == 1 && !$me ? array('options' => array('0' => array('selected' => true)), 'disabled' => true) : null;
                            
                            echo $form->dropDownList($q, 'anonym', $q->getAnonymOptions(), $options);
                        ?>
                        
                        <span id='custom_anonym'></span>

                        <script>
                            $("#Question_anonym")
                                    .change(function() {
                                if ($('#Question_anonym option:selected').attr('value') == 2) {
                                    $('#custom_anonym').html('<?php echo $form->textField($q, 'anonym_custom', array('id'=>'custom_anonym', 'style'=>'margin-bottom:-2px')); ?>');
                                } else {
                                    $('#custom_anonym').html('');
                                }
                            });

                            if ($('#Question_anonym option:selected').attr('value') == 2) {
                                $('#custom_anonym').html('<?php echo $form->textField($q, 'anonym_custom', array('id'=>'custom_anonym', 'style'=>'margin-bottom:-2px')); ?>');
                            }
                        </script>

                        <?php echo $form->hiddenField($q, 'to_id', array('value' => $model->id)) ?>
                        
                        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'label' => 'Ask', 'type' => 'info', 'htmlOptions'=>array('data-loading-text'=>"asking...", 'class'=>'ask-user-submit'))) ?>
                    
                    </div>
                <?php $this->endWidget(); ?>
            </div>
        </div>
        <?php
            $this->widget('zii.widgets.CListView', array(
                    'id' => 'questions',
                    'dataProvider' => $questions,
                    'itemView' => '//question/_feed',
                    'template' => '{items}{pager}',
                    'emptyText' => '
                        <div class="card" style="padding-top:0;">
                            <h3 class="card-heading simple">Nothing</h3>
                        </div>
                    ',
                    'pager' => array(
                        'class' => 'ext.ias.IasPager',
                        'rowSelector' => '.card',
                        'listViewId' => 'questions',
                        'header' => '',
                        'loaderText' => 'Loading ...',
                        'options' => array('history' => true, 'triggerPageTreshold' => 5, 'trigger' => 'More'),
                    )
                )
            );
        ?>
    </div>
    <div class="span4 hidden-phone">
        <div class="card ask-card">
            <div class="card-body" style="margin-top:0">
                <table class="table">
                    <tbody>
                      <tr>
                        <td style="border:0">Followers</td>
                        <td style="border:0"><?= $model->followers_n; ?></td>
                      </tr>
                      <tr>
                        <td>Answers</td>
                        <td><?= $model->answers_n; ?></td>
                      </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>