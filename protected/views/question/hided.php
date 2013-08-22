<?php  
    $baseUrl = Yii::app()->baseUrl; 
    $cs = Yii::app()->getClientScript();
    $cs->registerScriptFile($baseUrl.'/js/jquery-ias.min.js');
    $cs->registerScriptFile($baseUrl.'/js/ajax.js');
?>
<h1>Hided</h1><small>Here you can browse the qas you hided.</small><br />
<?php
$this->widget('zii.widgets.CListView', array(
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