<?php
require_once 'conf/config.php';
require_once 'lib/dbq.php';

if (isset($_GET['code'])) {
	if (!isset($_SESSION["test"])) {
		$url = "login.php/?code=" . $_GET['code'];
		Redirect($url);
	}
}

if (isset($_GET["action"])) {

	if ($_GET["action"] == 'schedule') {

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

		}
		if ($shed_rez == 1 || $shed_rez == 3) {

			$req_field = "sched";
			$value = 2;
			$condition_value = array();
			$condition_field = array();
			$condition_field[] = "player";
			$condition_field[] = "training";
			$condition_value[] = $vkid;
			$condition_value[] = $trid;
			$rez = update_field($table, $req_field, $value, $condition_field, $condition_value, $connectEDB);
			//echo $rez;
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
			//echo $rez;
			echo "Вы снова записались на тренировку";
		}

	} elseif ($_GET["action"] == 'traineredit') {
		$id = $_GET["id"];
		$name = $_GET["name"];
		$lastname = $_GET["surname"];
		$tel = $_GET["tel"];
		$vkid = $_GET["vkid"];
		$sex = $_GET["sex"];
		echo edit_trainer($connectEDB, $id, $name, $lastname, $tel, $vkid, $sex);
	} elseif ($_GET["action"] == 'traineradd') {
		$id = $_GET["id"];
		$name = $_GET["name"];
		$lastname = $_GET["surname"];
		$tel = $_GET["tel"];
		$vkid = $_GET["vkid"];
		$sex = $_GET["sex"];
		echo add_trainer($connectEDB, $id, $name, $lastname, $tel, $vkid, $sex);
	} elseif ($_GET["action"] == 'trainerdel') {
		$id = $_GET["id"];
		echo delete_trainer($connectEDB, $id);

	} elseif ($_GET["action"] == 'leveledit') {
		$id = $_GET["id"];
		$intensity = $_GET["intensity"];
		$description = $_GET['description'];
		$fields = array("id", "description", "intensity");
		$columns = array($id, $description, $intensity);
		$table = "training_level";
		edit_unit($connectEDB, $fields, $columns, $table);

	} elseif ($_GET["action"] == 'leveladd') {
		$id = $_GET["id"];
		$intensity = $_GET["intensity"];
		$description = $_GET['description'];
		$fields = array("description", "intensity");
		$columns = array($description, $intensity);
		$table = "training_level";
		echo add_unit($connectEDB, $fields, $columns, $table);

	} elseif ($_GET["action"] == 'leveldel') {
		$id = $_GET["id"];
		$table = "training_level";
		echo del_unit($connectEDB, $id, $table);
	}
}

function Redirect($url, $permanent = false) {
	header('Location: ' . $url, true, $permanent ? 301 : 302);

	exit();
}
?>
