<?php
///general
date_default_timezone_set('UTC');
///

///db
require_once("config.php");
global $pdodb;
try {
	$pdodb = new PDO ( 'mysql:host=' . $sqldb['host'] . ';dbname=' .  $sqldb['name'] ,  $sqldb['user'] , $sqldb['pass'] );
}
	catch(PDOException $e){
	echo 'DB-Error: '.$e->getCode();
	die();
}
$pdodb->query ( 'SET character_set_connection = utf8');
$pdodb->query ( 'SET character_set_client = utf8');
$pdodb->query ( 'SET character_set_results = utf8');
///

///user
require_once("php/ThUser.class.php");

$user = new ThUser(false);
$user->db=$pdodb;
$user->start();
///
?>