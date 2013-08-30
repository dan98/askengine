
<?php  
    $baseUrl = Yii::app()->baseUrl; 
    $cs = Yii::app()->getClientScript();
    $cs->registerScriptFile($baseUrl.'/js/jquery-ias.min.js');
    $cs->registerScriptFile($baseUrl.'/js/ajax.js');
    $cs->registerScriptFile($baseUrl.'/js/jquery.form.min.js');
?>

    <div class="card" style="padding-top:0; margin-bottom:0px;">
        <h3 class="card-heading simple">New questions</h3>
    </div>
<div class="row-fluid">
    <div class="span8">
        <?php
        $this->widget('zii.widgets.CListView', array(
                'id' => 'QuestionList',
                'dataProvider' => $dataProvider,
                'itemView' => '_new',
                'template' => '{items}<div style="clear: both;"></div>{pager}',
                'emptyText' => '
                <div align="center">
                    <div class="card" style="padding-top:0;display:inline-block;margin-top:30px;">
                        <h3 class="card-heading simple">No new questions found</h3>
                    </div>
                </div>
                ',
                'pager' => array(
                    'class' => 'ext.infiniteScroll.IasPager', 
                    'rowSelector'=>'.view', 
                    'listViewId' => 'QuestionList',

                    'loaderText'=>'Loading...',
                    'header' => '',
                    'options' => array('history' => true, 'triggerPageTreshold' => 5, 'trigger'=>'Load more'),
                )
            )
        );
        ?>
    </div>
    <div class="span4">
        <div class="card ask-card">
            <h3 class="card-heading simple">
                <?php
                    echo !empty($user->title) ? $user->title : 'Ask me a question';
                ?>
            </h3>
            <div class="card-body">
                <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array('id' => 'question-form'))?>
                    
                    <?php echo $form->errorSummary($q) ?>
                
                    <?php echo $form->textArea($q, 'question_text', array('rows' => 1, 'cols' => 40)) ?>
                
                    <div style="display:none;" class="display">
                        
                        <?php echo $form->textArea($q, 'answer_text', array('rows' => 1, 'cols' => 40)) ?>
                        <?php echo $form->fileField($q,'image', array('style'=>'margin-bottom:8px'));?>
                        <br />
                        <?php
                            echo $form->dropDownList($q, 'anonym', $q->getAnonymOptions());
                        ?>
                        
                        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'label' => 'Ask', 'type' => 'info')) ?>
                    <span id='custom_anonym'></span>
                        <script>
                            $("#Question_anonym")
                                    .change(function() {
                                if ($('#Question_anonym option:selected').attr('value') == 2) {
                                    $('#custom_anonym').html('<?php echo $form->textField($q, 'anonym_custom'); ?><br/>');
                                } else {
                                    $('#custom_anonym').html('');
                                }
                            });

                            if ($('#Question_anonym option:selected').attr('value') == 2) {
                                $('#custom_anonym').html('<?php echo $form->textField($q, 'anonym_custom'); ?>');
                            }
                        </script>
                    </div>
                <script>
                        $('#Question_question_text').click(function() {
                             $('.display').filter(function() {
                                return $(this).css('display') == 'none';
                            }).show();
                            $(this).attr('rows', 3);
                            $('#Question_answer_text').attr('rows', 3);
                        });
                    </script>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>