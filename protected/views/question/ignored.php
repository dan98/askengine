<?php  
    $baseUrl = Yii::app()->baseUrl; 
    $cs = Yii::app()->getClientScript();
    $cs->registerScriptFile($baseUrl.'/js/jquery-ias.min.js');
    $cs->registerScriptFile($baseUrl.'/js/ajax.js');
    $cs->registerScriptFile($baseUrl.'/js/jquery.form.min.js');
?>
<h1>New questions</h1><small>Here you can respond the questions you have.</small><br />
<?php
$this->widget('zii.widgets.CListView', array(
        'id' => 'QuestionList',
        'dataProvider' => $dataProvider,
        'itemView' => '_new',
        'template' => '{items}<div style="clear: both;"></div>{pager}',
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