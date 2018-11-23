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
		$rez_field = "sched";
		$fields_value = array($vkid, $trid);
		$req_fields = array('player', 'training');
		$shed_rez = find_by_cond($table, $req_fields, $fields_value, $rez_field, $connectEDB);
		if ($shed_rez === NULL) {
			$rez = sched_user($vkid, $trid, $connectEDB);
			echo "Вы записались на тренировку!";
			echo $rez;
		}
		if ($shed_rez == 1) {

			$req_field = "sched";
			$value = 2;
			$condition_value = array();
			$condition_field = array();
			$condition_field[] = "player";
			$condition_field[] = "training";
			$condition_value[] = $vkid;
			$condition_value[] = $trid;
			$rez = update_field($table, $req_field, $value, $condition_field, $condition_value, $connectEDB);
			echo $rez;
			echo "Вы отписались с тренировки";
		}
		if ($shed_rez == 2) {

			$req_field = "sched";
			$value = 1;
			$condition_value = array();
			$condition_field = array();
			$condition_field[] = "player";
			$condition_field[] = "training";
			$condition_value[] = $vkid;
			$condition_value[] = $trid;
			$rez = update_field($table, $req_field, $value, $condition_field, $condition_value, $connectEDB);
			echo $rez;
			echo "Вы снова записались на тренировку";
		}

	}
}

function Redirect($url, $permanent = false) {
	header('Location: ' . $url, true, $permanent ? 301 : 302);

	exit();
}
?>
