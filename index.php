<?php

// change the following paths if necessary
// $yii=dirname(__FILE__).'/../yii/framework/yii.php';
$yii=dirname(__FILE__).'/yii/framework/yiilite.php';
$config=dirname(__FILE__).'/protected/config/main.php';

require_once($yii);

defined('YII_DEBUG') or define('YII_DEBUG', false);

// Yii::createWebApplication($config)->run();
// enable gzip compression
$app = Yii::createWebApplication($config);
// attaching a handler to application start
/*Yii::app()->onBeginRequest = function($event)
{
// starting output buffering with gzip handler
return ob_start("ob_gzhandler");
};
// attaching a handler to application end
Yii::app()->onEndRequest = function($event)
{
// releasing output buffer
return ob_end_flush();
};*/
$app->run();


