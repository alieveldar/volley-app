<?php
//require "lib/vk.php";
require "lib/template.php";
require_once "conf/config.php";
//require_once "login.php";

//echo $_GET['code'];
if(isset($_GET['code'])){
	header("Location: login.php/?code=".$_GET['code']);
}
/*
 $v = new Vk(array(
		'client_id' => 6738467, // (обязательно) номер приложения
		'redirect_url' => 'https://lvh.me/auth',
		'display' => 'popup', 
		'scope' => 'wall,offline,email,friends,notify,photos', // права доступа
		'v' => '5.87' // не обязательно
	));

	$url = $v->get_code_token('code');

	echo $url;
	
if(!isset($_GET['code'])) {
	$url = $v->get_code_token('code');
	header("Location: $url");

} else {
	$access_token = $v->get_access_token($_GET['code']);
}
*/
?>