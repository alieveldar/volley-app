<?php
require_once 'conf/config.php';
require 'lib/dbq.php';

if (isset($_GET['code'])) {
	if (!isset($_SESSION["test"])) {
		$url = "/login.php/?code=" . $_GET['code'];
		Redirect($url);
	}
}

if (isset($_GET["action"])) {

	if ($_GET["action"] = 'schedule') {

		$vkid = $_GET['vkid'];
		$trid = $_GET['trid'];
		$table = 'event_training';
		$rez_field = "'scheduled'";
		$fields_value = array($vkid, $trid);
		$req_fields = array('player', 'training');
		$shed_rez = find_by_cond($table, $req_fields, $fields_value, $rez_field, $connectEDB);
		//echo var_dump($shed_rez);		
		echo $shed_rez["scheduled"];
		if ($shed_rez === 0 ){
			$rez = sched_user ($vkid, $trid, $connectEDB);
			echo $rez;
		}

	}
}

function Redirect($url, $permanent = false) {
	header('Location: ' . $url, true, $permanent ? 301 : 302);

	exit();
}
?>
