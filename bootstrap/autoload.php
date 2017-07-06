<?php

// setup
date_default_timezone_set('PRC');
error_reporting(E_ERROR);
define('APP_PATH', dirname(dirname(__FILE__)));
require_once APP_PATH . '/vendor/autoload.php';

// load env
$dotenv = new \Dotenv\Dotenv(APP_PATH);
$dotenv->load();
$env = env('APP_ENVIRONMENT');
$env = $env == 'development' ? $env : 'production';

// load facade
require_once APP_PATH . '/bootstrap/facade.php';
