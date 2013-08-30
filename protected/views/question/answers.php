<?php  
    $baseUrl = Yii::app()->baseUrl; 
    $cs = Yii::app()->getClientScript();
    $cs->registerScriptFile($baseUrl.'/js/jquery-ias.min.js');
    $cs->registerScriptFile($baseUrl.'/js/ajax.js');
?>
<h1>Answers</h1><small>Here you find the answers for your questions.</small>
<div class="questions">
    <?php
    $this->widget('zii.widgets.CListView',array(
            'id' => 'QuestionList',
            'dataProvider' => $dataProvider,
            'itemView' => '//question/_feed',
            'viewData' => array('likedcheck'=>false),
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
</div>