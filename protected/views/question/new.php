<div class="card" style="padding-top:0; margin-bottom:0px;">
    <h3 class="card-heading simple">New</h3>
</div>
<div class="row-fluid">
    <div class="span8">
        <?php
            $this->widget('zii.widgets.CListView',array(
                    'id' => 'questions',
                    'dataProvider' => $dataProvider,
                    'itemView' => '//question/_new',
                    'template' => '{items} {pager}',
                    'emptyText' => '
                    <div align="center">
                        <div class="card" style="padding-top:0;display:inline-block;margin-top:30px;">
                            <h3 class="card-heading simple">Nothing new</h3>
                        </div>
                    </div>
                    ',
                    'pager' => array(
                        'class' => 'ext.ias.IasPager', 
                        'rowSelector'=>'.card', 
                        'listViewId' => 'questions',
                        'header' => '',
                        'loaderText'=>'Loading ...',
                        'options' => array('history' => true, 'triggerPageTreshold' => 5, 'trigger'=>'More'),
                    )
                )
            );
        ?>
    </div>
    <div class="span4">
        <div class="card ask-card">
            <h3 class="card-heading simple">
                <?php
                    echo !empty($user->title) ? $user->title : 'Ask me';
                ?>
            </h3>
            <div class="card-body">
                <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array('id' => 'question-form', 'htmlOptions'=>array('enctype'=>"multipart/form-data")))?>
                    
                    <?php echo $form->errorSummary($q) ?>
                
                    <?php echo $form->textArea($q, 'question_text', array('rows' => 1, 'cols' => 40)) ?>
                
                    <div style="display:none;" class="display">
                        
                        <?php echo $form->textArea($q, 'answer_text', array('rows' => 1, 'cols' => 40)) ?>
                        <?php echo $form->fileField($q,'image', array('style'=>'margin-bottom:8px'));?>
                        <br />
                        <?php
                            echo $form->dropDownList($q, 'anonym', $q->getAnonymOptions());
                        ?>
                        
                        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'label' => 'Submit', 'type' => 'info')) ?>
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