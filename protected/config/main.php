<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'homeUrl'=>array('/',),
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'language'=>'es',
	// preloading 'log' component
	'preload'=>array('log'),
  'name'=>'Publicidad',
	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.components.TXDbMigration.*',
	),
  
	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'123',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
			'generatorPaths'=>array(
                'bootstrap.gii',
            ),
		),
	),

	// application components
	'components'=>array(
		'dbmigration' => array(
      'class'=>'application.components.TXDbMigration.TXDbMigration',
    ),
		'authManager'=>array(
			'class'=>'CDbAuthManager',
			'connectionID'=>'db',
		),
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		'product' => array(
      'class'=>'application.components.Product.CProduct',
    ),
    'filtro' => array(
        'class'=>'application.components.Product.CFiltro',
    ),
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>false,
			'caseSensitive'=>false, 
			// 'urlSuffix' => '.jsp',
			'rules'=>array(
				'user/profile'=>'user/profile',
				'product/<action:(create|admin|update|delete)>'=>'product/<action>',
				'product/<id:\w+>'=>'product/view',
				'search/<token:\w+>'=>'search/index',
				'<controller:\w+>/contact'=>'<controller>/contact',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
			),
		),	
		
		'db'=>array(
			'connectionString' => 'mysql:host=65.99.252.194;dbname=sidicweb_publicidad',
			'emulatePrepare' => true,
			'username' => 'sidicweb_normal',
			'password' => 'ZsdMk2cHljNA',
			'charset' => 'utf8',
			'tablePrefix' => '',
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning, info',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
		'bootstrap'=>array(
            'class'=>'bootstrap.components.Bootstrap',
        ),
	),

	'theme'=>'bootstrap', // requires you to copy the theme under your themes directory   
	// 'theme'=>'blog', // requires you to copy the theme under your themes directory   

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>require(dirname(__FILE__).'/params.php'), 
);