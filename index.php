<?php
/**
 * @author Chad Drennan
 * Date 1/15/20
 * @link /328/chicken/index.php
 */

ini_set("display_errors", 1);
error_reporting(E_ALL);

require("vendor/autoload.php");

// :: means to invoke a static method. -> means to use an instance method
$f3 = Base::instance();

$f3->route('GET /', function() {
    $view = new Template();
    echo $view->render('views/home.html');
    //echo "Hello Food";
});

// Define a breakfast route
$f3->route('GET /breakfast', function() {
   $view = new Template();
   echo $view->render('views/breakfast.html');
});

// Run F3
$f3->run();