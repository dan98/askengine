<?php
$this->pageTitle=Yii::app()->name . ' - Login';
?>
<style>
    #page{
        background-image:url(https://gs1.wac.edgecastcdn.net/8019B6/data.tumblr.com/55e507c18a8c5f5e1803d906e4d42563/tumblr_mrro2oWDW81qzfsnio1_1280.jpg);
        background-position:  center;
        padding: 70px 20px 70px 20px;
    }
    .welcome{
        color:white;
        margin:10px 0px 0px 20px;
        text-shadow: 0 2px 2px rgba(0,0,0,0.5);
        -webkit-font-smoothing: antialiased;
        font-smoothing: antialiased;
        opacity: .88;
        font-size: 16px;
        
    }
</style>
<div class="row-fluid">
    <div class="span7 ">
        <div class='welcome'>
            <h1>Querify</h1>
            <p>Let's ask some dirty things!</p>
        </div>
    </div>
    <div class='span5'>
        <div style="float:right;">
            <div class="well" style="margin-bottom:0">
                <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                    'id'=>'verticalForm',
                    'inlineErrors'=>true
                )); 
                ?>
                <blockquote><h4>Sign In<h4></blockquote>
                <?php echo $form->errorSummary($model, ''); ?>
                <div class="input-prepend">
                    <span class="add-on">@</span>
                    <?php echo $form->textField($model, 'email', array("autofocus"=>"autofocus")); ?>
                </div><br>
                <div class="input-prepend">
                    <span class="add-on">*</span>
                    <?php echo $form->passwordField($model, 'password');?>
                </div>
                <div>
                    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Sign In', 'type'=>'primary')); ?>
                    <?php $this->widget('application.modules.hybridauth.widgets.renderProviders'); ?>

                </div>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>