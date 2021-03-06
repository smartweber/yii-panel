<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Anonymizer',

	// preloading 'log' component
	'preload'=>array('log', 'booster'),

	// autoloading model and component classes
	'import'=>array(
		'ext.yii-mail.YiiMailMessage',
		'application.models.*',
		'application.components.*',),

	'modules'=>array
	(
		// uncomment the following to enable the Gii tool
/*
		'gii'=>array
		(
			'class'=>'system.gii.GiiModule',
			'password'=>'123',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1', '46.162.0.41'),
                        'generatorPaths' => array('booster.gii')
		),
*/
	),

	// application components
	'components'=>array(
		'booster' => array('class' => 'ext.yiibooster.components.Booster'),
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin' => true,
		),
		'mail' => array(
		    'class' => 'ext.yii-mail.YiiMail',
		     'transportType'=>'smtp',
		    'viewPath' => 'application.views.mail',
		    'logging' => true,
		    'dryRun' => false
		),		
		
		// uncomment the following to enable URLs in path-format
		/*
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		*/
//		'db'=>array(
//			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
//		),
		// uncomment the following to use a MySQL database
		'db'=>array(
			'connectionString' => 'mysql:host=127.0.0.1;dbname=anonymizer',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
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
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
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