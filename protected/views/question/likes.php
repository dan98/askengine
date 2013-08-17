<h1>Likes</h1><small>Here you find the questions you liked.</small>
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
<?php  
  $baseUrl = Yii::app()->baseUrl; 
  $cs = Yii::app()->getClientScript();
  $cs->registerScriptFile($baseUrl.'/js/jquery-ias.min.js');
  $cs->registerScriptFile($baseUrl.'/js/feed.js');
?>
<script>
dislikelink = function(event){
    event.preventDefault();
    var url = $(this).attr('href');
    $.ajax({
        type:'POST',
        url: url,
        context: $(this).parent().parent(),
        success:function(){
            $(this).parent().hide("slow");
        },
        beforeSend:function(){
            $(this).html("deleting ... ");
        }
    });
};
refreshbinds();
</script>