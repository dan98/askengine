<?php
$this->widget('zii.widgets.CListView', array(
        'id' => 'QuestionList',
        'dataProvider' => $dataProvider,
        'itemView' => '_new',
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
<?php  
  $baseUrl = Yii::app()->baseUrl; 
  $cs = Yii::app()->getClientScript();
  $cs->registerScriptFile($baseUrl.'/js/jquery-ias.min.js');
  $cs->registerScriptFile($baseUrl.'/js/feed.js');
?>