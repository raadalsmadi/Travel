<?php 

$options = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8', # Option Encoding Utf8
);
$con  = new PDO("mysql:host=localhost;dbname=travel","root","",$options);
if(!$con){
	echo "Error Connect Database";
}