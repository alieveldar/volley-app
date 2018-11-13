<?php
const TNEWS               = 'news';
const TROOTS              = 'roots';
const TTRAINER            = 'trainer'; 
const TTRAINING           = 'training'; 
const TTRAINIG_LEVEL      = 'training_level' ;
const TTRAINIG_REP        = 'training_repeatability';
const TUSERS              = 'users'; 
const TVKFRIENDS          = 'vkfriends'; 
const TVOLLEY_ROOM        = 'volley_room'; 
 $dbservice  = array(
 'dbhost' => 'lvh.me',
 'dbname' =>'eDb',
 'dbuser' => 'volleyadmin',
 'dbpassword' => 'volley2018'
);
 $v = array(
		'client_id' => 	6739525, // (обязательно) номер приложения
		'secret_key' => 'Z1G1vY4Hj2fxbG1qkTmA', // (обязательно) получить тут https://vk.com/editapp?id=6738467&section=options где 12345 - client_id
		'user_id' => 12345, // ваш номер пользователя в вк
		'scope' => 'wall', // права доступа
		'v' => '5.87'
		);
$connectEDB = mysqli_connect($dbservice['dbhost'],$dbservice['dbuser'],$dbservice['dbpassword'], $dbservice['dbname']);
session_save_path ("/var/tmp");



?>