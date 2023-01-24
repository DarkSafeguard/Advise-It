<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once('vendor/autoload.php');

session_start();

$f3 = Base::instance();
$con = new Controller($f3);
$dataLayer = new DataLayer();

$f3->route('GET /', function(){
    $GLOBALS['con']->home();
});

$f3->route('GET /plan', function(){
    $GLOBALS['con']->createPlan();
});

$f3->route('GET|POST /plan/@token', function($f3){
    $GLOBALS['con']->getPlan($f3->get('PARAMS.token'));
});

$f3->run();