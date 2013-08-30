<?php  
    $baseUrl = Yii::app()->baseUrl; 
    $cs = Yii::app()->getClientScript();
    $cs->registerScriptFile($baseUrl.'/js/ajax.js');
?>

<div class="card" style="padding-top:0; margin-bottom:0px;">
    <h3 class="card-heading simple">Feed</h3>
</div>
<div class="row-fluid">
    <div class="span8">
        <?php
            $this->widget('zii.widgets.CListView',array(
                    'id' => 'QuestionList',
                    'dataProvider' => $dataProvider,
                    'itemView' => '//question/_feed',
                    'template' => '{items} {pager}',
                    'emptyText' => '
                        <div class="card" style="padding-top:0;">
                            <h3 class="card-heading simple">No answers, houston.</h3>
                        </div>
                    ',
                    'pager' => array(
                        'class' => 'ext.infiniteScroll.IasPager', 
                        'rowSelector'=>'.card', 
                        'listViewId' => 'QuestionList',
                        'header' => '',
                        'loaderText'=>'Loading...',
                        'options' => array('history' => true, 'triggerPageTreshold' => 5, 'trigger'=>'Load more'),
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
                        <td style="border:0"><?= $user->followers_n; ?></td>
                      </tr>
                      <tr>
                        <td>Following</td>
                        <td><?= $user->following_n; ?></td>
                      </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>