<div class="view" style ="width:300px!important; float: left; margin-left: 18px;" id="question-view-<?php echo $data->id; ?>">
    
    <span style="float:left">
        - <?php echo CHtml::encode($data->question_text); ?>
        <small>
            <?php 
            switch($data->anonym)
            {
                case 0 :echo CHtml::link('('.$data->sender->firstname." ".$data->sender->lastname.')', array('user/view/', $data->sender->id)); break;
                case 1 :echo '(anonym)'; break;
                case 2 :echo '('.$data->anonym_custom.')'; break;
            }
            ?>
        </small>
    </span>
    <div align="right" style="clear:both">
        <?php
        if($data->status == 0 && $data->from_id != Yii::app()->user->id)
        {
            $url = Yii::app()->createUrl('question/ignore/', array('ajax'=>1, 'id'=>$data->id));
            echo CHtml::link('ignore',$url, array('class'=>'ignore-link'));
        }
        else
        {
            $url = Yii::app()->createAbsoluteUrl('question/delete/', array('ajax'=>1, 'id'=>$data->id));
            echo CHtml::link('delete',$url, array('class'=>'delete-link'));
        }
        echo ' ';
        $url = Yii::app()->createUrl('question/respond/', array('ajax'=>1, 'id'=>$data->id));
        echo CHtml::link('response',$url, array('class'=>'response-link'));    
        ?>
    </div>
</div>