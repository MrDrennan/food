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

$f3->route('GET /breakfast/buffet', function() {
    $view = new Template();
    echo $view->render('views/breakfast-buffet.html');
});

// Lunch
$f3->route('GET /lunch', function() {
    $view = new Template();
    echo $view->render('views/lunch.html');
});

// Accepts a food parameter
// @ means word is a place holder. uses it as parameter if not a route
// $params is an optional parameter
$f3->route('GET /@item', function($f3, $params) {
    //var_dump($params);
    $item = $params['item'];
    echo "<p>You ordered $item</p>";

    $foodsWeServe = array("tacos", "pizza", "lumpia");
    if (!in_array($item, $foodsWeServe)) {
        echo "<p>Sorry... we don't serve $item</p>";
    }

    switch($item) {
        case 'tacos' :
            echo "<p>We serve tacos on Tuesdays</p>";
            break;
        case 'pizza':
            echo "<p>Pepperoni or veggie?</p>";
            break;
        case 'bagels':
            $f3->reroute("/breakfast");
        default:
            $f3->error(404);
    }
});

$f3->route('GET /order', function() {
    $view = new Template();
    echo $view->render('views/order.html');
});

// Run F3
$f3->run();