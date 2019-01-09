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
	$referer = 0;
	if ($_GET["action"] == 'schedule') {
		if (isset($_GET['referer'])) {
			$referer = $_GET['referer'];
		}
		$vkid = $_GET['vkid'];
		$trid = $_GET['trid'];

		$table = 'event_training';
		$rez_field = "sched";
		$fields_value = array($vkid, $trid);
		$req_fields = array('player', 'training');
		$shed_rez = find_by_cond($table, $req_fields, $fields_value, $rez_field, $connectEDB);
		if ($shed_rez === NULL) {
			if (check_player_intruding($connectEDB, $vkid, $trid)) {
				if ($referer == 0) {
				} else {
					echo "Ваш друг не может одновременно быть в двух разных местах";
					exit();
				}

			}
			$rez = sched_user($vkid, $trid, $connectEDB, $referer);
			if ($referer == 0) {
				echo "Вы записались на тренировку!";
			} else {
				add_friend_to_userlist($connectEDB, $vkid);
				echo "Вы записали друга на тренировку";
			}

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
			//echo $rez;
			if (check_expiration_day($connectEDB, $vkid, $trid)) {
				echo "Время записи на тренировку инстекло";
				exit();
			}
			if ($referer == 0) {
				$rez = update_field($table, $req_field, $value, $condition_field, $condition_value, $connectEDB);
				echo "Вы отписались с тренировки";
			} else {

				echo "Этот участник уже записан";
			}
		}
		if ($shed_rez == 2) {
			if (check_player_intruding($connectEDB, $vkid, $trid)) {
				echo "Вы не можете одновременно быть в двух разных местах";
			} else {
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
				if ($referer == 0) {
					echo "Вы снова записались на тренировку";
				} else {
					echo "Вы снова записали друга на тренировку";
				}
			}

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
	} elseif ($_GET['action'] == 'groupedit') {
		$id = $_GET['id'];
		$vkids = $_GET['idvk'];
		$groupname = $_GET['groupname'];
		del_mess_list_group($connectEDB, $id);
		edit_mess_group_name($connectEDB, $id, $groupname);
		echo edit_mess_group($connectEDB, $id, $vkids);
	} elseif ($_GET['action'] == 'groupadd') {
		$vkids = $_GET['idvk'];
		$groupname = $_GET['groupname'];
		echo add_mess_group($connectEDB, $groupname, $vkids);
	} elseif ($_GET['action'] == 'groupdel') {
		$id = $_GET['id'];
		$vkids = $_GET['idvk'];
		$groupname = $_GET['groupname'];
		del_mess_list_group($connectEDB, $id);
		echo del_mess_group($connectEDB, $id);
	} elseif ($_GET['action'] == 'sendmesstraining') {
		$trainingid = $_GET["trid"];
		$message = $_GET['message'];
		$flag = 1;
		$rez = send_group_message($connectEDB, $trainingid, $message, $flag);
		//echo var_dump($rez);
		//echo $rez;
		echo "Сообщение отправлено, его получат лишь те пользователи у которых нет запрета получения сообщений из данного сообщества!";
	} elseif ($_GET['action'] == 'sendmessgroup') {
		$trainingid = $_GET["grid"];
		$message = $_GET['message'];
		$flag = 0;
		$rez = send_group_message($connectEDB, $trainingid, $message, $flag);
		//echo var_dump($rez);
		//echo $rez;
		echo "Сообщение отправлено, его получат лишь те пользователи у которых нет запрета получения сообщений из данного сообщества!";
	} elseif ($_GET['action'] == 'friendssearch') {
		$trid = $_GET["trid"];
		$vkid = $_GET['vkid'];
		$reqtemplate = $_GET['q'];
		$list = search_friends_vk($connectEDB, $vkid, $reqtemplate, $trid);
		echo $list;
	} elseif ($_GET['action'] == 'removefriend') {
		$trid = $_GET["trid"];
		$vkid = $_GET['vkid'];
		$referer = $_GET['referer'];
		echo remove_friend_from_training($connectEDB, $trid, $vkid, $referer);
	} elseif ($_GET['action'] == 'get_train_users') {
		$trid = $_GET["trid"];
		echo get_train_users($connectEDB, $trid);
	} elseif ($_GET['action'] == 'check_intruders') {
		$trid = $_GET["trid"];
		$vkid = $_GET["vkid"];
		echo check_intruders($connectEDB, $trid, $vkid);
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
