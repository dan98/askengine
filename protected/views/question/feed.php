<?php  
    $baseUrl = Yii::app()->baseUrl; 
    $cs = Yii::app()->getClientScript();
    $cs->registerScriptFile($baseUrl.'/js/ajax.js');
?>
<div class="page-header">
    <h1>Feed</h1>
    <small>Here you can read the qas of people you follow.</small>
</div>
<?php
$this->widget('zii.widgets.CListView',array(
        'id' => 'QuestionList',
        'dataProvider' => $dataProvider,
        'itemView' => '//question/_feed',
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