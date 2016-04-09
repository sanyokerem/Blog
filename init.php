<?php 


spl_autoload_register(function($class){
	if (is_file("controller/" . $class . ".php")){
		require("controller/" . $class . ".php");
	} elseif(is_file("model/" . $class . ".php")) {
		require("model/" . $class . ".php");
	}
});

require 'App.php'; 
require 'Router.php';
session_start();

$user = NULL;
if(isset($_SESSION['user'])){
	$user = $_SESSION['user'];
}


$db = new PDO('mysql:host=localhost;', 'root','');
if($db->exec("CREATE DATABASE `OOP`")){
	$db->exec("USE `OOP`");

	$db->exec("CREATE TABLE IF NOT EXISTS `posts` (
				`id` int(11) PRIMARY KEY AUTO_INCREMENT,
				`title` char(50) DEFAULT NULL,
				`content` text,
				`user_name` char(50) DEFAULT NULL,
				`date` datetime DEFAULT NULL)
	");

	$db->exec("CREATE TABLE IF NOT EXISTS `users` (
				`id` int(11) PRIMARY KEY AUTO_INCREMENT,
				`name` char(50) DEFAULT NULL UNIQUE KEY,
				`pass` char(60) DEFAULT NULL)
	");
}else{
	$db->exec("USE `OOP`");
}


