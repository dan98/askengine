<?php
$this->pageTitle=Yii::app()->name . ' - Login';
?>
<style>
    #page{
        background-image:url("/img/page-background.png");
        background-position:  left;
        background-size: cover;
        padding: 70px 20px 70px 20px;
        position:relative;
    }
    .welcome{
        color:white;
        margin:10px 0px 0px 20px;
        text-shadow: 0 2px 2px rgba(0,0,0,0.5);
        -webkit-font-smoothing: antialiased;
        font-smoothing: antialiased;
        font-size: 16px;
        
    }
    .welcome h1, .welcome p{
        opacity: .8;
    }
    .welcome-span{
        background: url('/img/vignetter.png');
        background-size: 100% 100%;
        background-repeat: no-repeat;
        background-origin: content-box;
        position: absolute;
        margin-top: -200px!important;
        margin-left: -400px!important;
        width:1020px!important;
        height:440px;
        
    }
    @media(max-width: 767px){
        #page {
            margin-top: 86px!important;
        }
    }
    .login-span{
        z-index: 10;
        position: relative;
    }
</style>

<div class="row-fluid">

    <div class="span7">
        <div class='welcome'>    
            <div class="welcome-span">
            </div>
            <h1>Welcome to Querify</h1>
            <p>Read people you want to know better.</p>
        </div>
    </div>
    <div class='span5' align='center' style="position: relative;">
        <div class='login-well' align='left'>
            <div class="well" style="margin-bottom:0">
                <style>
                    @media(max-width: 767px){
                        
                        .login-well{
                            width:90%!important;
                        }
                    }
                    .input-prepend input, .input-prepend   {
                        /* Firefox */
                        width: -moz-calc(100% - 25px)!important;
                        /* WebKit */
                        width: -webkit-calc(100% - 25px)!important;
                        /* Opera */
                        width: -o-calc(100% - 25px)!important;
                        /* Standard */
                        width: calc(100% - 25px)!important;
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
                    <span style="margin-left: 10px;"><?php $this->widget('application.modules.hybridauth.widgets.renderProviders'); ?></span>
                </div>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>