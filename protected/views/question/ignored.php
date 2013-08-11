<?php  
  $baseUrl = Yii::app()->baseUrl; 
  $cs = Yii::app()->getClientScript();
  $cs->registerScriptFile($baseUrl.'/js/jquery-ias.min.js');
?>
<?php
$this->widget('zii.widgets.CListView', array(
       'id' => 'QuestionList',
       'dataProvider' => $dataProvider,
       'itemView' => '_new',
       'template' => '{items} {pager}',
       'pager' => array(
                    'class' => 'ext.infiniteScroll.IasPager', 
                    'rowSelector'=>'.row', 
                    'listViewId' => 'QuestionList', 
                    'header' => '',
                    'loaderText'=>'Loading...',
                    'options' => array('history' => true, 'triggerPageTreshold' => 10, 'trigger'=>'Load more'),

           )
            )
       );
?>
<script>
jQuery.ias({'history':false,'triggerPageTreshold':10,'trigger':'More','container':'#QuestionList > .items','item':'.view','pagination':'#QuestionList .pager','next':'#QuestionList .next:not(.disabled):not(.hidden) a','loader':'Loading...'});
</script>