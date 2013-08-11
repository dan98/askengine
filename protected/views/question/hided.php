<div class="questions">
<?php
$this->widget('zii.widgets.CListView', array(
       'id' => 'QuestionList',
       'dataProvider' => $dataProvider,
       'itemView' => '//question/_view',
       'template' => '{items} {pager}',
       'pager' => array(
                    'class' => 'ext.infiniteScroll.IasPager', 
                    'rowSelector'=>'.row', 
                    'listViewId' => 'QuestionList', 
                    'header' => '',
                    'loaderText'=>'Loading...',
                    'options' => array('history' => true, 'triggerPageTreshold' => 3, 'trigger'=>'Load more'),

           )
            )
       );
?>
</div>
<?php  
  $baseUrl = Yii::app()->baseUrl; 
  $cs = Yii::app()->getClientScript();
  $cs->registerScriptFile($baseUrl.'/js/jquery-ias.min.js');
?>
<script>
    
jQuery.ias({'history':true,'triggerPageTreshold':3,'trigger':'Загрузить еще','container':'#QuestionList > .items','item':'.view','pagination':'#QuestionList .pager','next':'#QuestionList .next:not(.disabled):not(.hidden) a','loader':'Загрузка'});

function refreshbinds(){
   $('.hide-link').unbind('click');
   $('.hide-link').bind('click', hideandshowlink);
   $('.show-link').unbind('click');
   $('.show-link').bind('click', hideandshowlink);
}
hideandshowlink = function(event){
    event.preventDefault();
    var url = $(this).attr('href');
    $.ajax({
        type:'POST',
        url: url,
        context: this,
        beforeSend:function(){
             $(this).parent().parent().hide('slow');
        }
    });
};


refreshbinds();
</script>
