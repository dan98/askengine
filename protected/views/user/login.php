<?php
$this->pageTitle=Yii::app()->name . ' - Login';
?>
<style>
    #page{
        background-image:url("https://gs1.wac.edgecastcdn.net/8019B6/data.tumblr.com/8bc4114d07e8e12eaaad89ed287abd04/tumblr_mjk8jtdZEP1s8pls4o1_1280.jpg");
        background-position:  left;
        background-size: cover;
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
    @media(max-width: 767px){
        #page {
            margin-top: 86px!important;
        }
    }
</style>
<div class="row-fluid">
    <div class="span7 ">
        <div class='welcome'>
            <h1>Welcome to Querify</h1>
            <p>Ask questions and read strange people.</p>
        </div>
    </div>
    <div class='span5' align='center'>
        <div class='login-well' align='left'>
            <div class="well" style="margin-bottom:0">
                <style>
                    @media(max-width: 767px){
                        .input-prepend, .input-prepend input {
                            /* Firefox */
                            width: -moz-calc(100% - 29px)!important;
                            /* WebKit */
                            width: -webkit-calc(100% - 29px)!important;
                            /* Opera */
                            width: -o-calc(100% - 29px)!important;
                            /* Standard */
                            width: calc(100% - 29px)!important;
                        }
                        .login-well{
                            width:90%!important;
                        }
                    }
                </style>
                <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                    'id'=>'verticalForm',
                    'inlineErrors'=>true
                )); 
                ?>
                <blockquote>
                    <h3>Sign In</h3>
                </blockquote>
                <?php echo $form->errorSummary($model, ''); ?>
                <div class="input-prepend">
                    <span class="add-on">@</span>
                    <?php echo $form->textField($model, 'email', array("autofocus"=>"autofocus")); ?>
                </div><br>
                <div class="input-prepend">
                    <span class="add-on" style=''>*</span>
                    <?php echo $form->passwordField($model, 'password');?>
                </div>
                <div>
                    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Sign In', 'type'=>'primary', 'htmlOptions'=>array( 'class'=>'login-btn'))); ?>
                    <?php $this->widget('application.modules.hybridauth.widgets.renderProviders'); ?>

                </div>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>