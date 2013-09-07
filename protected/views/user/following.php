<div class="card" style="padding-top:0; margin-bottom:0px;">
    <h3 class="card-heading simple">Following</h3>
</div>
<div class="row-fluid">
    <div class="span10 offset1">
        <?php
            $this->widget('zii.widgets.CListView',array(
                    'id' => 'followers',
                    'dataProvider' => new CActiveDataProvider('User', array(
                            'data'=>$user->following,
                    )),
                    'itemView' => '//user/_view',
                    'template' => '{items} {pager}',
                    'emptyText' => '
                    <div align="center">
                        <div class="card" style="padding-top:0;display:inline-block;margin-top:30px;">
                            <h3 class="card-heading simple">Don\'t follow anybody.</h3>
                        </div>
                    </div>
                    ',
                    'pager' => array(
                        'class' => 'ext.ias.IasPager', 
                        'rowSelector'=>'.view', 
                        'listViewId' => 'followers',
                        'header' => '',
                        'loaderText'=>'Loading ...',
                        'options' => array('history' => true, 'triggerPageTreshold' => 5, 'trigger'=>'More'),
                    )
                )
            );
        ?>
    </div>
</div>
