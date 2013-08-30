<?php  
    $baseUrl = Yii::app()->baseUrl; 
    $cs = Yii::app()->getClientScript();
    $cs->registerScriptFile($baseUrl.'/js/ajax.js');
?>

<div class="card" style="padding-top:0; margin-bottom:0px;">
    <h3 class="card-heading simple">Following</h3>
</div>
<div class="row-fluid">
    <div class="span10 offset1">
        <?php
            $this->widget('zii.widgets.CListView',array(
                    'id' => 'FollowersList',
                    'dataProvider' => new CActiveDataProvider('User', array(
                            'data'=>$user->following,
                    )),
                    'itemView' => '//user/_view',
                    'template' => '{items} {pager}',
                    'emptyText' => '
                    <div align="center">
                        <div class="card" style="padding-top:0;display:inline-block;margin-top:30px;">
                            <h3 class="card-heading simple">You don\'t follow anybody, houston.</h3>
                        </div>
                    </div>
                    ',
                    'pager' => array(
                        'class' => 'ext.infiniteScroll.IasPager', 
                        'rowSelector'=>'.view', 
                        'listViewId' => 'FollowersList',
                        'header' => '',
                        'loaderText'=>'Loading...',
                        'options' => array('history' => true, 'triggerPageTreshold' => 5, 'trigger'=>'Load more'),
                    )
                )
            );
        ?>
    </div>
</div>
