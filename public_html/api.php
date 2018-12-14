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
		$fields = array("description", "intensity");
		$columns = array($description, $intensity);
		$table = "training_level";
		echo edit_unit($connectEDB, $fields, $columns, $table, $id);

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

	} elseif ($_GET["action"] == 'roomedit') {
		$id = $_GET["id"];
		$roomname = $_GET["roomname"];
		$roomcity = $_GET['roomcity'];
		$roomadress = $_GET['roomadress'];
		$roomimage = $_GET['roomimage'];
		$roomiya = $_GET['roomiya'];
		$fields = array("id", "name", 'city', 'adress', 'image', 'ya_map');
		$columns = array($id, $roomname, $roomcity, $roomadress, $roomimage, $roomiya);
		$table = "volley_room";
		echo edit_unit($connectEDB, $fields, $columns, $table, $id);

	} elseif ($_GET["action"] == 'roomadd') {
		$roomname = $_GET["roomname"];
		$roomcity = $_GET['roomcity'];
		$roomadress = $_GET['roomadress'];
		$roomimage = $_GET['roomimage'];
		$roomiya = $_GET['roomiya'];
		$fields = array("name", 'city', 'adress', 'image', 'ya_map');
		$columns = array($roomname, $roomcity, $roomadress, $roomimage, $roomiya);
		$table = "volley_room";
		echo add_unit($connectEDB, $fields, $columns, $table);

	} elseif ($_GET["action"] == 'roomdel') {
		$id = $_GET["id"];
		$table = "volley_room";
		echo del_unit($connectEDB, $id, $table);
	} elseif ($_GET["action"] == 'rootedit') {
		$id = $_GET["id"];
		$rootname = $_GET["rootname"];
		$rootsurname = $_GET['rootsurname'];
		$rootidvk = $_GET['rootidvk'];
		$role = "1";
		$fields = array("id", "first_name", 'last_name', 'id_vk', 'role');
		$columns = array($id, $rootname, $rootsurname, $rootidvk, $role);
		$table = "roots";
		echo edit_unit($connectEDB, $fields, $columns, $table, $id);

	} elseif ($_GET["action"] == 'rootadd') {
		$id = $_GET["id"];
		$rootname = $_GET["rootname"];
		$rootsurname = $_GET['rootsurname'];
		$rootidvk = $_GET['rootidvk'];
		$role = "1";
		$fields = array("first_name", 'last_name', 'id_vk', 'role');
		$columns = array($rootname, $rootsurname, $rootidvk, $role);
		$table = "roots";
		echo add_unit($connectEDB, $fields, $columns, $table, $id);

	} elseif ($_GET["action"] == 'rootdel') {
		$id = $_GET["id"];
		$table = "roots";
		echo del_unit($connectEDB, $id, $table);

	} elseif ($_GET["action"] == 'newsedit') {
		$id = $_GET["id"];
		$newstext = $_GET["newstext"];
		$fields = array("id", "text");
		$columns = array($id, $newstext);
		$table = "news";
		echo edit_unit($connectEDB, $fields, $columns, $table, $id);

	} elseif ($_GET["action"] == 'newsadd') {
		$newstext = $_GET["newstext"];
		$fields = array("text");
		$columns = array($newstext);
		$table = "news";
		echo add_unit($connectEDB, $fields, $columns, $table);

	} elseif ($_GET["action"] == 'newsdel') {
		$id = $_GET["id"];
		$table = "news";
		echo del_unit($connectEDB, $id, $table);
	} elseif ($_GET["action"] == "trainingedit") {
		$id = $_GET['id'];
		$fields = array();
		$columns = array();
		$table = 'training';
		//$count = 0;
		foreach ($_GET as $key => $value) {

			if ($key != "action" & $key != "id") {
				if ($key == 'date' || $key == 'start_time') {
					$fields[] = $key;
					$columns[] = $value;
				}
				$rez = check_values_training($value);
				if ($rez != 0) {
					$fields[] = $key;
					$columns[] = $value;
				}
			}
		}

		echo edit_unit($connectEDB, $fields, $columns, $table, $id);
		//echo "fields" . var_dump($fields) . "COLUMNS" . var_dump($columns);

	} elseif ($_GET['action'] == 'trainingadd') {
		$fields = array();
		$columns = array();
		$table = 'training';
		foreach ($_GET as $key => $value) {

			if ($key != "action" & $key != "id") {
				if ($key == 'date' || $key == 'start_time') {
					$fields[] = $key;
					$columns[] = $value;
				}
				$rez = check_values_training($value);
				if ($rez != 0) {
					$fields[] = $key;
					$columns[] = $value;
				}
			}
		}
		echo add_unit($connectEDB, $fields, $columns, $table);
	} elseif ($_GET['action'] == 'trainingdel') {
		$id = $_GET['id'];
		$table = 'training';
		echo del_unit($connectEDB, $id, $table);
		del_unit_training($connectEDB, $id);
	}

}
function Redirect($url, $permanent = false) {
	header('Location: ' . $url, true, $permanent ? 301 : 302);

	exit();
}

function check_values_training($value) {
	if (is_numeric($value)) {
		return $value;
	} else {
		return 0;
	}
}
?>
