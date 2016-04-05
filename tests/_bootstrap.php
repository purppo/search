<?php
$loader = require(__DIR__.'/../vendor/autoload.php');
//$loader->add('qwe', __DIR__ . '/../src');
//$loader->register();
//include __DIR__ . "/../vendor/autoload.php";
// This is global bootstrap for autoloading
$kernel = AspectMock\Kernel::getInstance();
$kernel->init(
                [
                'debug' => TRUE,
                //'appDir' => __DIR__ . '/../../unit',
                'includePaths' => [__DIR__.'/../inc',__DIR__.'/../lib'],
                'excludePaths' => [__DIR__]
                //'interceptFunctions' => true,
                ]
);

//$kernel->loadFile(__DIR__.'/../vendor/autoload.php');