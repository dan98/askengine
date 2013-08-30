<?php
    $me = $model->id == Yii::app()->user->id ? true : false;
?>
    
<?php
    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerScriptFile($baseUrl.'/js/jquery-ias.min.js');
    $cs->registerScriptFile($baseUrl.'/js/ajax.js');
?>

<div class="white-block">
    <div class="view-image" align='right'>
        <?php
            if($model->gravatar){
                $this->widget('application.extensions.VGGravatarWidget.VGGravatarWidget', 
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
            }else{
                if($model->image){
                    $imghtml=CHtml::image('/avatar-thumb/'.$model->image->image, 'title', array('width'=>80, 'height'=>80));
                    echo CHtml::link($imghtml, array('/'.$model->id), array('ajaxlink' => 'link'));
                }else{
                    $this->widget('application.extensions.VGGravatarWidget.VGGravatarWidget', 
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
                '<button class="btn btn-success btn-small" name="yt0" type="button">update</button>',
                $this->createAbsoluteUrl('user/update', array('id' => $model->id)),
                array(
                    'ajaxlink' => 'true'
                )
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
                    echo !empty($model->title) ? $model->title : 'Ask me a question';
                ?>
            </h3>
            <div class="card-body">
                <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array('id' => 'question-form'))?>
                    
                    <?php echo $form->errorSummary($q) ?>
                
                    <?php echo $form->textArea($q, 'question_text', array('rows' => 1, 'cols' => 40)) ?>
                    <script>
                        $('#Question_question_text').click(function() {
                             $('.display').filter(function() {
                                return $(this).css('display') == 'none';
                            }).show();
                            $(this).attr('rows', 4);
                        });
                    </script>
                    
                    <div style="display:none;" class="display">
                        
                        <?php
                            $options = $model->anonym_questions == 1 ? array('options' => array('0' => array('selected' => true)), 'disabled' => true) : null;
                            
                            echo $form->dropDownList($q, 'anonym', $q->getAnonymOptions(), $options);
                        ?>
                        
                        <span id='custom_anonym'></span>

                        <script>
                            $("#Question_anonym")
                                    .change(function() {
                                if ($('#Question_anonym option:selected').attr('value') == 2) {
                                    $('#custom_anonym').html('<?php echo $form->textFieldRow($q, 'anonym_custom'); ?>');
                                } else {
                                    $('#custom_anonym').html('');
                                }
                            });

                            if ($('#Question_anonym option:selected').attr('value') == 2) {
                                $('#custom_anonym').html('<?php echo $form->textField($q, 'anonym_custom'); ?>');
                            }
                        </script>

                        <?php echo $form->hiddenField($q, 'to_id', array('value' => $model->id)) ?>
                        
                        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'label' => 'Ask', 'type' => 'info')) ?>
                    
                    </div>
                <?php $this->endWidget(); ?>
            </div>
        </div>
        <?php
            $this->widget('zii.widgets.CListView', array(
                    'id' => 'QuestionList',
                    'dataProvider' => $questions,
                    'itemView' => '//question/_feed',
                    'template' => '{items} {pager}',
                    'emptyText' => '
                        <div class="card" style="padding-top:0;">
                            <h3 class="card-heading simple">No answers, houston.</h3>
                        </div>
                    ',
                    'pager' => array(
                        'class' => 'ext.infiniteScroll.IasPager',
                        'rowSelector' => '.card',
                        'listViewId' => 'QuestionList',
                        'header' => '',
                        'loaderText' => 'Loading...',
                        'options' => array('history' => true, 'triggerPageTreshold' => 5, 'trigger' => 'Load more'),
                    )
                )
            );
        ?>
    </div>
    <div class="span4">
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