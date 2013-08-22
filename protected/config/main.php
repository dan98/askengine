<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Querify',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
                'application.vendors.*',
                'ext.time.Time',
                'ext.eactivedataprovider.EActiveDataProvider',
                'application.modules.hybridauth.controllers.*'
	),

	'modules'=>array(
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>false,
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
                'hybridauth' => array(
                    'baseUrl' => 'http://'. $_SERVER['SERVER_NAME'] . '/hybridauth', 
                    'withYiiUser' => false, // Set to true if using yii-user
                    "providers" => array (
                        "facebook" => array ( 
                            "enabled" => true,
                            "keys"    => array ( "id" => "118691594972672", "secret" => "2d26ed337ce8b8ccb0f1eca070aa83d5" ),
                            "scope"   => "email,publish_stream,user_birthday, publish_actions, user_likes, user_about_me", 
                            "display" => "" 
                        )
                    )
                )
            ),
            'onBeginRequest' => function () {
                if (!Yii::app()->user->isGuest) {
                        Yii::app()->defaultController = 'question';
                }else{
                        Yii::app()->defaultController = 'user/login';
                }
            },
	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
                        'loginUrl' => '/',
                        'returnUrl' => '/',
                        'class' => 'WebUser',
		),
                'bootstrap'=>array(
                    'class'=>'bootstrap.components.Bootstrap',
                ),
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>false,
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
                                '<id:\d+>'=>'user/view/',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
                                '/me'=>'/user/view'
			),
		),
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=askengine',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
			'tablePrefix' => 'tbl_',
                        'enableProfiling'=>true,
                        'enableParamLogging'=>true,
		),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
                            array(
                                    'class'=>'CFileLogRoute',
                                    'levels'=>'error, warning'
                            ),
                            
                            array(
                                    'class'=>'ext.yii-debug-toolbar.yii-debug-toolbar.YiiDebugToolbarRoute',
                            )
                        ),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);