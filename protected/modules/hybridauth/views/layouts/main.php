<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootplus.min.css"  />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootplus-responsive.min.css" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->
        <style>
            body {-webkit-font-smoothing: antialiased;}@font-face {
                font-family: 'Roboto';
                font-style: normal;
                font-weight: 400;
                src: url(//ssl.gstatic.com/fonts/roboto/v9/grlryt2bdKIyfMSOhzd1eA.woff) format('woff');
              }
              @font-face {
                font-family: 'Roboto';
                font-style: normal;
                font-weight: 700;
                src: url(//ssl.gstatic.com/fonts/roboto/v9/vxNK-E6B13CyehuDCmvQvw.woff) format('woff');
              }
              @font-face {
                font-family: 'Roboto';
                font-style: normal;
                font-weight: 300;
                src: url(//ssl.gstatic.com/fonts/roboto/v9/d-QWLnp4didxos_6urzFtg.woff) format('woff');
              }

        </style>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/font-awesome.min.css" />
	
        <style type="text/css">
            @font-face {
               font-family: 'FontAwesome';
               src: url('<?php echo Yii::app()->request->baseUrl; ?>/font/fontawesome-webfont.eot?v=3.1.1');
               src: url('<?php echo Yii::app()->request->baseUrl; ?>/font/fontawesome-webfont.eot?#iefix&v=3.1.1') format('embedded-opentype'),
               url('<?php echo Yii::app()->request->baseUrl; ?>/font/fontawesome-webfont.woff?v=3.1.1') format('woff'),
               url('<?php echo Yii::app()->request->baseUrl; ?>/font/fontawesome-webfont.ttf?v=3.1.1') format('truetype');
               font-weight: normal;
               font-style: normal;
            }
        </style>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="shortcut icon" href="/img/favicon.png" type="image/x-icon">
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <?php
        $baseUrl = Yii::app()->baseUrl; 
        $cs = Yii::app()->getClientScript();
        $cs->registerScriptFile($baseUrl.'/js/jquery-pjax.js');
        ?>
        <script>
            $('a[ajaxlink]').pjax('#page');
            $('button[ajaxbutton]').pjax('#page');
        </script>
        <script type="text/javascript">
            if (window.location.hash == '#_=_') {
                window.location.hash = ''; // for older browsers, leaves a # behind
                history.pushState('', document.title, window.location.pathname); // nice and clean
                e.preventDefault(); // no page reload
            }
        </script>
</head>

<body>
    <div class="container main-container">
        <div class="row-fluid">
            <div id="sidebar">
                <?php
                    
                    if(!Yii::app()->user->isGuest){
                        $question_number = Question::model()->new()->mine()->count() == 0 ? '' : ' (<span id="question-number">'.Question::model()->new()->mine()->count().'</span>)';
                        $this->widget('bootstrap.widgets.TbMenu',array(
                                 'type'=>'list',
                                 
                                 'htmlOptions' => array('style'=>'margin-bottom:20px;display:inline-block;'),
                                 'items'=>array(
                                        array('label'=>'Feed', 'url'=>'/', 'linkOptions'=>array('ajaxlink'=>'true')),
                                        array('label'=>'Me', 'url'=>array('/me'), 'linkOptions'=>array('ajaxlink'=>'true')),
                                    ),
                         ));echo "<br />";
                        $this->widget('bootstrap.widgets.TbMenu',array(
                                 'type'=>'list',
                                'htmlOptions' => array('style'=>'margin-bottom:20px;display:inline-block;'),
                                 'items'=>array(
                                        array('label'=>'Questions'.$question_number, 'url'=>array('/question/new/'), 'linkOptions'=>array('ajaxlink'=>'true')),
                                        array('label'=>'Answers', 'url'=>array('/question/likes/'), 'linkOptions'=>array('ajaxlink'=>'true')),
                                ),
                         ));echo "<br />";
                        $this->widget('bootstrap.widgets.TbMenu',array(
                                 'type'=>'list',
                                'htmlOptions' => array('class'=>'sidebar-h-ul'),
                                 'items'=>array(
                                        array('url'=>array('/user/logout'), 'icon'=>'off',  'visible'=>!Yii::app()->user->isGuest),
                                 ),
                         ));
                        $this->widget('bootstrap.widgets.TbMenu',array(
                                 'type'=>'list',
                                'htmlOptions' => array('class'=>'sidebar-h-ul'),
                                 'items'=>array(
                                        array('url'=>array('/user/update/'.Yii::app()->user->id), 'icon'=>'gears',  'visible'=>!Yii::app()->user->isGuest)
                                 ),
                         ));
                        
                    }else{
                        $this->widget('bootstrap.widgets.TbMenu',array(
                            
                                 'type'=>'list',
                                'htmlOptions' => array('style'=>'display:inline-block;'),
                                'items'=>array(
                                        array('label'=>'Login', 'url'=>array('/user/login'), 'linkOptions'=>array('ajaxlink'=>'true')),
                                        array('label'=>'Register', 'url'=>array('/user/create'), 'linkOptions'=>array('ajaxlink'=>'true'))
                                ),
                        )); 
                    } 
                ?>
            </div>
            
            <?php if(0 == 1){ ?>
            <script>
                $('#sidebar').hover(
                    function(){
                        $('#sidebar').animate({
                            left: "0px",
                            easing:"easeInOutQuint",
                            opacity: 1
                        }, 400);
                    },
                    function(){
                        $('#sidebar').animate({
                            left: "-160px",
                            easing:"easeInOutQuint",
                            opacity:0.25
                        }, 400);
                });
            </script>
            <?php } ?>
            <style>
                #sidebar{
                    position: fixed;
                    left:20px;
                    width:200px;
                    padding-left: 10px;
                }
            </style>
            <div class="<?php echo Yii::app()->user->isGuest ? 'span10' : 'span9'?> offset1">
                <div id="page">
                    <?php echo $content; ?>
                    <div class="clear"></div>
                </div>
                <div class="footer">
                        <p>Creat de <a href="/user/15" ajaxlink="true">Daniel Grosu</a>, based on Yii and Twitter Bootstrap.</p>
                </div>
            </div>
        </div>
    </div
</body>
</html>
