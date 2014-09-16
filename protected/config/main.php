<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');
Yii::setPathOfAlias('aws', dirname(__FILE__).'/../extensions/aws');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Video Manager - Gerenciamento de Vídeos',
        //tema
        'theme'=>'bootstrap',
        //linguagem padrão
        'language'=>'pt_br',
	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
                'bootstrap.helpers.*'
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'123456',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
                        'generatorPaths' => array('bootstrap.gii'),
		),
	),
    
	// application components
	'components'=>array(
                'bootstrap'=>array(
                    'class'=>'bootstrap.components.Bootstrap',
                ),
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
                        'showScriptName'=>false,
		),
		/*'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),*/
		// uncomment the following to use a MySQL database
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=videomanagerdb',
			'emulatePrepare' => true,
			'username' => 'admin',
			'password' => 'admin',
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
				array(
					'class'=>'CWebLogRoute',
				),
			),
		),
                'aws'=>array(
                    'class'=>'aws.aws-autoloader'
                ),
                's3'=>array(
                  'class' => 'ext.es3.ES3', // so the ES3 class must sit at protected/extensions/es3/ES3.php
                  'aKey' => 'AKIAJ3BKRST5UJGYGTVA', // your account key, obtain from Amazon
                  'sKey' => 'rTXQypulsBQ9mjP0EsnrAuWNRceruWrkcUPNCdQA', // your secret key, obtain from Amazon
                  //'region' => 'sa-east-1', //region of the bucket
                ),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
                'videoUploadDir' => 'files/videos/',
                //amazon configurations
                'videoS3Bucket'=>'videocongresso01',
                'cloudFrontWeb'=>'https://d2jdnwq9ajs5cn.cloudfront.net/',
                'cloudFrontRTMP'=>'rtmp://s17z6bfw0vxwrz.cloudfront.net/cfx/st/',
                //'maxUploadFileSize'=>700097152,
                'maxUploadFileSize'=>700297152,
	),
);
