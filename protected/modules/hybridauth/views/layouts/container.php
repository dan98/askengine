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
        
        <?php /* Title */ ?>	
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        
        <?php /* Register javascript files */ ?>
        <?php
        $baseUrl = Yii::app()->baseUrl; 
        $cs = Yii::app()->getClientScript();
        $cs->registerScriptFile($baseUrl.'/js/jquery-pjax.min.js'); // ajax navigation
        $cs->registerScriptFile($baseUrl.'/js/ajax.js'); // ajax script
        $cs->registerScriptFile($baseUrl.'/js/bootstrap.min.js'); // bootstrap javascript
        $cs->registerScriptFile($baseUrl.'/js/skylo.min.js'); // progressive bar
        $cs->registerScriptFile($baseUrl.'/js/jstorage.min.js'); // jstorage (set and get values in browser)
        ?>
        
        <?php /* Ajax navigation init */ ?>
        <script>
            $('#sidebar a:not(.noajax), a[ajaxlink]').pjax('#page');
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
        /* Get User row and image */
        $user = User::model()->findByPk($id);
        
        /* Set the items for navbar */
        $questions = $newquestions_n == 0 ? 'Questions' : "Questions <span class=\"badge badge-info\">{$newquestions_n}</span>" ;
        $answers = $newanswers_n == 0 ? 'Răspunsuri' : "Răspunsuri <span class=\"badge badge-info\">{$newanswers_n}</span>" ;

        $items = array(
            array('label'=>'Feed', 'url'=>'/'),
            array('label'=>'Me', 'url'=>'/'.$id),
            array('label'=>$questions, 'url'=>'/new'),
            array('label'=>$answers, 'url'=>'/answers'),
            array('label'=>'Likes', 'url'=>'/likes'),
            array('label'=>'Hided', 'url'=>'/hided'),
            array('label'=>'Ignored', 'url'=>'/ignored'),
            array('label'=>'Following', 'url'=>'/following'),
            array('label'=>'Settings', 'url'=>'/user/update/'.Yii::app()->user->id),
            array('label'=>'Exit', 'url'=>'/logout')                                                              
        );
    }else{
        /* Set the items for navbar */
        $items = array(
            array('label'=>'Login', 'url'=>array('/login')),
            array('label'=>'Register', 'url'=>array('/register'))         
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
                    'items'=>$items,'encodeLabel'=>false,
                )
            )
        )
    );
    ?>
    <div id="sidebar" class="hidden-phone hidden-tablet">
        <?php if(!Yii::app()->user->isGuest){ ?>
            <div style="margin-bottom:30px;">
                    <div class="avatar" style="margin-left:27px">
                    <?php 
                    if($user->gravatar){
                            $this->widget('ext.gravatar.Gravatar', 
                                array(
                                    'email' => $user->email,
                                    'hashed' => false, 
                                    'default' => 'identicon',                                                
                                    'size' => 60,
                                    'href' => '/'.$user->id,
                                    'rating' => 'PG',
                                    'htmlOptions' => array('alt' =>$user->firstname.' '.$user->lastname),
                                )
                           );
                        }else{
                            if($user->image){
                                $imghtml=CHtml::image('/avatar-thumb/'.$user->image->image, 'Imagine de profil', array('width'=>60, 'height'=>60));
                                echo CHtml::link($imghtml, array('/'.$user->id));
                            }else{
                                $this->widget('ext.gravatar.Gravatar', 
                                    array(
                                        'email' => $user->email,
                                        'hashed' => false, 
                                        'default' => 'identicon',                                                
                                        'size' => 60,
                                        'href' => '/'.$user->id,
                                        'rating' => 'PG',
                                        'htmlOptions' => array('alt' =>$user->firstname.' '.$user->lastname, 'style'=>'float:left;'),
                                    )
                                );
                            }
                        }
                    ?>
                 </div>
            </div>
        <?php } ?>
        <?php
            if(!Yii::app()->user->isGuest){

                $questions = 'Q'. ( $newquestions_n == 0 ? '' : "<span class=\"badge badge-info badge-sidebar\">{$newquestions_n}</span>") ;
                $answers = 'A'. ( $newanswers_n == 0 ? '' : "<span class=\"badge badge-info badge-sidebar\">{$newanswers_n}</span>") ;
                
        ?>        
                <div>
                    <?php
                            $this->widget('bootstrap.widgets.TbMenu',array(
                                    'type'=>'list',
                                    'encodeLabel'=>false,
                                    'items'=>array(
                                        array('label'=>$questions, 'url'=>array('/new')),
                                    ),
                                )
                            );
                            $this->widget('bootstrap.widgets.TbMenu',array(
                                    'type'=>'list',
                                    'encodeLabel'=>false,
                                    'items'=>array(
                                            array('label'=>$answers, 'url'=>array('/answers')),
                                    ),
                                )
                            );
                    ?>
                </div>
                <div>
                    <?php
                            $this->widget('bootstrap.widgets.TbMenu',array(
                                    'type'=>'list',
                                    'encodeLabel'=>false,
                                    'items'=>array(
                                        array('label'=>'&nbsp;I&nbsp;', 'url'=>array('/ignored')),
                                    ),
                                )
                            );
                            $this->widget('bootstrap.widgets.TbMenu',array(
                                    'type'=>'list',
                                    'encodeLabel'=>false,
                                    'items'=>array(
                                            array('label'=>'H', 'url'=>array('/hided')),
                                    ),
                                )
                            );
                    ?>
                </div>
                <div>
                    <?php
                            $this->widget('bootstrap.widgets.TbMenu',array(
                                    'type'=>'list',
                                    'encodeLabel'=>false,
                                    'items'=>array(
                                        array('label'=>'&nbsp;Following&nbsp;&nbsp;', 'url'=>array('/following')),
                                    ),
                                )
                            );
                    ?>
                </div>
                <div>
                    <?php
                            $this->widget('bootstrap.widgets.TbMenu',array(
                                    'type'=>'list',
                                    'encodeLabel'=>false,
                                    'items'=>array(
                                        array('label'=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Likes&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', 'url'=>array('/likes')),
                                    ),
                                )
                            );
                    ?>
                </div>
                <?php
                        $this->widget('bootstrap.widgets.TbMenu',array(
                                'type'=>'list',
                                'items'=>array(
                                    array('url'=>'/logout', 'icon'=>'off', 'linkOptions'=>array('class'=>'noajax')),
                                ),
                            )
                        );
                        $this->widget('bootstrap.widgets.TbMenu',array(
                                'type'=>'list',
                                'items'=>array(
                                    array('url'=>'/user/update/'.$id, 'icon'=>'gears')
                                ),
                            )
                        );
                ?>
        
            <?php
                }else{
                    $this->widget('bootstrap.widgets.TbMenu',array(
                            'type'=>'list',
                            'items'=>array(
                                array('label'=>'Login', 'url'=>'/login'),
                                array('label'=>'Register', 'url'=>'/register')
                            ),
                        )
                    ); 
                } 
            ?>
        
        <?php if(!Yii::app()->user->isGuest){ ?> 
        <br />
        <i class="icon-pushpin" id="hide-sidebar" style="cursor:pointer;opacity:0.2"></i>
        <style>
        @media(min-width: 1680px){
            
        }
        </style>
        <script>
            <?php /* Hide sidebar */ ?>
            function hidesidebar() {
                $('#sidebar').hover(
                    function(){
                        $('#sidebar').stop();
                        $('#sidebar').animate({
                            left: "0px",
                            easing:"easeInOutQuint",
                            opacity: 1
                        }, 200);
                    },
                    function(){
                        $('#sidebar').stop();
                        $('#sidebar').animate({
                            left: "-170px",
                            easing:"easeInOutQuint",
                            opacity:0.25
                        }, 200);
                });
            }
            if($.jStorage.get('hide-sidebar') == 1){
                $('#hide-sidebar').removeClass('icon-rotate-90');
                hidesidebar();
                $('#sidebar').css({left: "-170px"});
            }else{
                $('#hide-sidebar').addClass('icon-rotate-90');
            }
            $('#hide-sidebar').click(function (){
                if($.jStorage.get('hide-sidebar') == 1){
                    $.jStorage.set('hide-sidebar', 0);
                    $('#sidebar').unbind('hover');
                    $('#hide-sidebar').addClass('icon-rotate-90');
                }else{
                    $.jStorage.set('hide-sidebar', 1);
                    hidesidebar();
                    $('#hide-sidebar').removeClass('icon-rotate-90');
                }
            });
        </script>
        <?php } ?> 
    </div>
    <?php echo $content; ?>
</body>
</html>