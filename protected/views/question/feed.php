<div class="card" style="padding-top:0; margin-bottom:0px;">
    <h3 class="card-heading simple">Feed</h3>
</div>
<div class="row-fluid">
    <div class="span10 offset1">
        <?php
            $this->widget('zii.widgets.CListView',array(
                    'id' => 'questions',
                    'dataProvider' => $dataProvider,
                    'itemView' => '//question/_feed',
                    'template' => '{items} {pager}',
                    'emptyText' => '
                    <div align="center">
                        <div class="card" style="padding-top:0;display:inline-block;margin-top:30px;">
                            <h3 class="card-heading simple">Nothing</h3>
                        </div>
                    </div>
                    ',
                    'pager' => array(
                        'class' => 'ext.ias.IasPager', 
                        'rowSelector'=>'.card', 
                        'listViewId' => 'questions',
                        'header' => '',
                        'loaderText'=>'Loading ...',
                        'options' => array('history' => true, 'triggerPageTreshold' => 10, 'trigger'=>'More'),)
                    )
            );
        ?>
    </div>
</div>