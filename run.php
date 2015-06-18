#!/usr/bin/php
<?php
define("nl","\n");

// few environement checks
if(PHP_SAPI !== "cli") {
	die("This script should be used on command line interface! Terminating. Bye!");
}
require "config.php";
require "rb.php";
require "functions.php";

set_error_handler('errHandle');

R::setup( "mysql:host=localhost;dbname=$dbname", $dbuser, $dbpass );

require 'vendor/autoload.php';

// Introduce the class into your scope
use kamranahmedse\Geocode;

$postne = R::findAll('postne');
$country = "Slovenia";

foreach($postne as $posta){
	$address = $posta->id . " " . $posta->posta . ", ".$country;
	$geocode = new Geocode( $address );
	$lat = $geocode->getLatitude();
	$long = $geocode->getLongitude();
	$posta->lat = $lat;
	$posta->long = $long;
	$id = R::store($posta);
	if(!empty($id))
		echo $id . " " . $address . " " . $long . " " . $lat . nl;
	sleep(1);
}

echo "End!".nl.nl;