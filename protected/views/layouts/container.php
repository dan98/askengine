<?php /* Main layout */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
        <?php /* Meta tags */ ?>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
        <meta name="viewport" content="width=device-width, initial-scale=0.95">
            
	<?php /* Bootplus distro of twitter bootstrap */ ?>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootplus.min.css"  />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootplus-responsive.min.css" />
	
        <?php /* Main style */ ?>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	
        <?php /* Progress bar style */ ?>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/skylo.css" />
	
        <?php /* Font awesome icons */ ?>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/font-awesome.min.css" />
 
        <?php /* Favicon */ ?>
        <link rel="shortcut icon" href="/img/favicon.png" type="image/x-icon">
        
        <?php /* Font Robot and Font awesome */ ?>
        <style>
            body {-webkit-font-smoothing: antialiased;}
            @font-face {
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
        
        <?php /* Title */ ?>	
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        
        <?php /* Register javascript files */ ?>
        <?php
        $baseUrl = Yii::app()->baseUrl; 
        $cs = Yii::app()->getClientScript();
        $cs->registerScriptFile($baseUrl.'/js/jquery-pjax.js'); // ajax navigation
        $cs->registerScriptFile($baseUrl.'/js/bootstrap.min.js'); // bootstrap javascript
        $cs->registerScriptFile($baseUrl.'/js/skylo.js'); // progressive bar
        ?>
        
        <?php /* Ajax navigation init */ ?>
        <script>
            $('a[ajaxlink]').pjax('#page');
        </script>
        
        <?php /* Remove #_=_ from facebook returnUrl */ ?>
        <script type="text/javascript">
            if (window.location.hash == '#_=_') {
                window.location.hash = ''; // for older browsers, leaves a # behind
                history.pushState('', document.title, window.location.pathname); // nice and clean
                e.preventDefault(); // no page reload
            }
        </script>
</head>
    
<?php
    if(!Yii::app()->user->isGuest){
        /* Query the database for new answers or questions */
        $newquestions_n = Question::model()->new()->mine()->count();
        $newanswers_n = Question::model()->notseen()->fromme()->count();
        /* Set id user */
        $id = Yii::app()->user->id;
        
        /* Set the items for navbar */
        $questions = $newquestions_n == 0 ? 'Questions' : "Questions <span class=\"badge badge-info badge-sidebar\">{$newquestions_n}</span>" ;
        $answers = $newanswers_n == 0 ? 'Answers' : "Answers <span class=\"badge badge-info badge-sidebar\">{$newanswers_n}</span>" ;

        $items = array(
            array('label'=>'Feed', 'url'=>'/', 'linkOptions'=>array('ajaxlink'=>'true')),
            array('label'=>'Me', 'url'=>'/'.$id, 'linkOptions'=>array('ajaxlink'=>'true')),
            array('label'=>$questions, 'url'=>'/new', 'linkOptions'=>array('ajaxlink'=>'true')),
            array('label'=>$answers, 'url'=>'/answers', 'linkOptions'=>array('ajaxlink'=>'true')),
            array('label'=>'Following', 'url'=>'/following', 'linkOptions'=>array('ajaxlink'=>'true')),
            array('label'=>'Settings', 'url'=>'/user/update/'.Yii::app()->user->id, 'linkOptions'=>array('ajaxlink'=>'true')),
            array('label'=>'Logout', 'url'=>'/logout', 'linkOptions'=>array('ajaxlink'=>'true'))                                                              
        );
    }else{
        /* Set the items for navbar */
        $items = array(
            array('label'=>'Login', 'url'=>array('/login'), 'linkOptions'=>array('ajaxlink'=>'true')),
            array('label'=>'Register', 'url'=>array('/register'), 'linkOptions'=>array('ajaxlink'=>'true'))         
        );
    }
?>
    
<body>
    <?php
    $this->widget('bootstrap.widgets.TbNavbar', array('brand'=>'Querify', 'brandUrl'=>'#', 'collapse'=>true,
            'htmlOptions'=>array(
                'class'=>'no-transition hidden-desktop navbar-absolute'
            ),
            'items'=>array(
                array(
                    'class'=>'bootstrap.widgets.TbMenu',
                    'items'=>$items
                )
            )
        )
    );
    ?>
    <div id="sidebar" class="hidden-phone hidden-tablet">
        <?php
            $linkoptions = array('ajaxlink'=>'true');

            if(!Yii::app()->user->isGuest){

                $questions = $newquestions_n == 0 ? 'Q' : "Q<span class=\"badge badge-info badge-sidebar\">{$newquestions_n}</span>" ;
                $answers = $newanswers_n == 0 ? 'A' : "A<span class=\"badge badge-info badge-sidebar\">{$newanswers_n}</span>" ;
                
                $this->widget('bootstrap.widgets.TbMenu',array(
                    'type'=>'list',
                    'htmlOptions' => array('style'=>'margin-bottom:20px;display:inline-block;'),
                    'items'=>array(
                            array('label'=>'Feed', 'url'=>'/', 'linkOptions'=>$linkoptions),
                            array('label'=>'Me', 'url'=>'/'.$id, 'linkOptions'=>$linkoptions),
                        )
                    )
                );
        ?>
                <div class='sidebar-h-ul-container'>
        <?php
                $this->widget('bootstrap.widgets.TbMenu',array(
                        'type'=>'list',
                        'encodeLabel'=>false,
                        'htmlOptions' => array('class'=>'sidebar-h-ul'),
                        'items'=>array(
                            array('label'=>$questions, 'url'=>array('/new'), 'linkOptions'=>array('ajaxlink'=>'true')),
                        ),
                    )
                );
                $this->widget('bootstrap.widgets.TbMenu',array(
                        'type'=>'list',
                        'encodeLabel'=>false,
                        'htmlOptions' => array('class'=>'sidebar-h-ul'),
                        'items'=>array(
                                array('label'=>$answers, 'url'=>array('/answers'), 'linkOptions'=>array('ajaxlink'=>'true')),
                        ),
                    )
                );
        ?>
                </div>
                <div class='sidebar-h-ul-container'>
        <?php
                $this->widget('bootstrap.widgets.TbMenu',array(
                        'type'=>'list',
                        'encodeLabel'=>false,
                        'htmlOptions' => array('class'=>'sidebar-h-ul'),
                        'items'=>array(
                            array('label'=>'Following', 'url'=>array('/following'), 'linkOptions'=>array('ajaxlink'=>'true')),
                        ),
                    )
                );
        ?>
                </div>
        <?php
                $this->widget('bootstrap.widgets.TbMenu',array(
                        'type'=>'list',
                        'htmlOptions' => array('class'=>'sidebar-h-ul'),
                        'items'=>array(
                            array('url'=>'/logout', 'icon'=>'off'),
                        ),
                    )
                );
                $this->widget('bootstrap.widgets.TbMenu',array(
                        'type'=>'list',
                        'htmlOptions' => array('class'=>'sidebar-h-ul'),
                        'items'=>array(
                            array('url'=>'/user/update/'.$id, 'linkOptions'=>$linkoptions, 'icon'=>'gears')
                        ),
                    )
                );
        ?>
        <?php
            }else{
                $this->widget('bootstrap.widgets.TbMenu',array(
                        'type'=>'list',
                        'htmlOptions' => array('class'=>'sidebar-h-ul'),
                        'items'=>array(
                            array('label'=>'Login', 'url'=>'/login', 'linkOptions'=>$linkoptions),
                            array('label'=>'Register', 'url'=>'/register', 'linkOptions'=>$linkoptions)
                        ),
                    )
                ); 
            } 
        ?>
        
        <?php 
        /*
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
        */
        ?>
    </div>
    <?php echo $content; ?>
    <div align="center" style="bottom:0; width:100%">
        <div class="card" style="padding-top:0;display:inline-block;margin-top:60px;">
            <h6 class="card-heading">a <a href="/1" ajaxlink="true">Daniel Grosu</a> production</h6>
        </div>
    </div>
</body>
</html>
