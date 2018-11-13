<?php
session_start();
if(isset($_GET['code'])){
	if(!isset ($_SESSION["test"])){
	$url = "/login.php/?code=".$_GET['code'];
	Redirect($url);
}
	}
	
	function Redirect($url, $permanent = false)
{
    header('Location: ' . $url, true, $permanent ? 301 : 302);

    exit();
}
?>
<HTML><H1>LOADING</H1></HTML>