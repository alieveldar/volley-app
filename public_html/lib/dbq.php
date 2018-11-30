<?php
require_once 'conf/config.php';
require_once 'lib/template.php';
$current_user;
function get_alltraining($connectEDB, $vkid) {

	$week = array();
	$day_name = '';

	for ($i = 1; $i <= 7; $i++) {
		$day = $i;
		$sql_find_training = "SELECT training.day_of_week, training_level.description, volley_room.adress, training.start_time, training.capacity, trainer.first_name, trainer.last_name, trainer.tel, volley_room.ya_map,volley_room.image, training.date, training.price, training_level.intensity, training.id
FROM training, volley_room, training_level, trainer
WHERE training.day_of_week =" . $day . " AND training.level = training_level.id AND training.volley_room = volley_room.id AND training.trainer = trainer.id";
		mysqli_set_charset($connectEDB, "utf8");
		switch ($i) {
		case 1:
			$week["понедельник"] = mysqli_query($connectEDB, $sql_find_training);
			break;
		case 2:
			$week["вторник"] = mysqli_query($connectEDB, $sql_find_training);
			break;
		case 3:
			$week["среда"] = mysqli_query($connectEDB, $sql_find_training);
			break;
		case 4:
			$week["четверг"] = mysqli_query($connectEDB, $sql_find_training);
			break;
		case 5:
			$week["пятница"] = mysqli_query($connectEDB, $sql_find_training);
			break;
		case 6:
			$week["суббота"] = mysqli_query($connectEDB, $sql_find_training);
			break;
		case 7:
			$week["воскресение"] = mysqli_query($connectEDB, $sql_find_training);
			break;
		}
	}

	return td_and_modal($week, $connectEDB, $vkid);
}

function td_and_modal($week, $connectEDB, $vkid) {

	$day = 'frst';
	$contacts = 'temproary var';
	$mod_arr = array();
	$col_arr = array();
	$rez_row = array();
	$rez_mod = array();

	foreach ($week as $dayarr => $value) {
		$tp_row = New Template;
		$tp_row->get_tpl('templates/row.tpl');
		$day_count = 0;

		foreach ($value as $my) {
			global $day;
			$tp_col = New Template;
			$tp_modal = New Template;

			$tp_col->get_tpl('templates/col.tpl');
			$tp_modal->get_tpl('templates/modal.tpl');

			$day = $dayarr;
			$image_url = $my["image"];
			$cell_id = "cell" . $my["id"];
			$adress = str_replace(", Казань", "", $my["adress"]);
			$shedcount = get_count_shed($connectEDB, $my['id']);
			$capacity = $shedcount . "/" . $my["capacity"];
			$contacts = "NOT VAR HERE";
			$ya_map = $my["ya_map"];
			$date = $my["date"];
			$price = $my["price"];
			$training_desc = $my["description"];
			$intensity = $my["intensity"];
			$start_time = $my["start_time"][0] . $my["start_time"][1] . ":" . $my["start_time"][2] . $my["start_time"][3];
			$tp_modal->set_value('DAY', $day);
			$tp_modal->set_value('CELL_ID', $cell_id);
			$tp_modal->set_value('ADRESS', $adress);
			$tp_modal->set_value('CAPACITY', $capacity);
			$tp_modal->set_value('CONTACTS', $contacts);
			$tp_modal->set_value('YA_MAP', $ya_map);
			$tp_modal->set_value('DATE', $date);
			$tp_modal->set_value('PRICE', $price);
			$tp_modal->set_value('TRAINING_DESC', $training_desc);
			$tp_modal->set_value('vkid', $vkid);
			$tp_modal->set_value('trid', $my["id"]);
			$sched = find_by_cond("event_training", array("player", "training"), array($vkid, $my["id"]), "sched", $connectEDB);
			if ($sched === NULL) {
				$schedbutton = "Записаться";
			} elseif ($sched == 1) {
				$schedbutton = "Отписаться";
			} elseif ($sched == 2) {
				$schedbutton = "Записаться";
			}
			$tp_modal->set_value('sched', $sched);
			$tp_modal->set_value('schedbutton', $schedbutton);
			$tp_col->set_value('CELL_ID', $cell_id);
			$tp_col->set_value('IMAGE_URL', $image_url);
			$tp_col->set_value('INTENSITY', $intensity);
			$tp_col->set_value('ADRESS', $adress);
			$tp_col->set_value('START_TIME', $start_time);
			$tp_col->set_value('CAPACITY', $capacity);
			$shed_users = get_shed_users($my["id"], $connectEDB, $vkid); ///////////////
			$tp_modal->set_value('SHED_USERS', $shed_users);
			$tp_modal->tpl_parse();
			$tp_col->tpl_parse();
			global $col_arr;
			global $mod_arr;
			$col_arr[] = $tp_col->html;
			$mod_arr[] = $tp_modal->html;
			unset($tp_col, $tp_modal);
		} //day end
		global $rez_row, $rez_mod, $col_arr, $mod_arr, $day;
		if (count($col_arr) > 0) {

			$tp_row->set_value('DAY', $day);
			$tp_row->set_value('SCHEDULE', implode($col_arr));
			$tp_row->tpl_parse();
			$rez_row[] = $tp_row->html;
			$rez_mod[] = implode($mod_arr);
			global $day;
			$day = '';
			$col_arr = array();
			$mod_arr = array();
		}
	}

	$result[] = implode($rez_row);
	$result[] = implode($rez_mod);
	return $result;
}
function find_by_cond($table = "event_training", $req_fields = array("player", "training"), $fields, $rez_field = "sched", $connectEDB) {
	$req_sql = "SELECT * FROM " . $table . " WHERE "
		. $req_fields[0] . "=" . $fields[0] . " AND " . $req_fields[1] . "=" . $fields[1];

	if ($rez = mysqli_query($connectEDB, $req_sql)) {

	} else {

	}
	$rez = mysqli_fetch_assoc($rez);
	return $rez["sched"];
}
function sched_user($vkid, $trid, $connectEDB) {
	$shed_es = 1;
	$req_sql1 = "INSERT INTO event_training (training,player,sched) VALUES ($trid,$vkid,'$shed_es')";
	$rez_sched = mysqli_query($connectEDB, $req_sql1);
	if ($rez_sched) {
		return 1;
	} else {
		return mysqli_error($connectEDB);
		//return $req_sql;
	}
}
function update_field($table, $req_field, $value, $condition_field, $condition_value, $connectEDB) {
	$req_sql = "UPDATE $table SET $req_field=$value WHERE $condition_field[0]=$condition_value[0] AND $condition_field[1]=$condition_value[1]";
	$rez_update = mysqli_query($connectEDB, $req_sql);
	if ($rez_update) {
		return $req_sql;
	} else {
		return mysqli_error($connectEDB);
	}
}
function get_user_vk($vkid, $connectEDB) {
	$ssid = gets_ssid($connectEDB);
	sleep(1);
	$vk_user_data = json_decode(file_get_contents("https://api.vk.com/method/users.get?user_ids=" . $vkid . "&fields=first_name,last_name,photo_50&access_token=" . $ssid . "&v=5.87"));

	return $vk_user_data;
}
function get_shed_users($trid, $connectEDB, $vkid) {
	global $current_user;
	$rezarr = array();
	$users_sql = "SELECT player FROM event_training WHERE training = $trid AND sched = 1";
	$rez = mysqli_query($connectEDB, $users_sql);

	foreach ($rez as $value) {
		$rezarr[] = $value;
	}
	$arr_cols = array();

	if ($rez != NULL) {
		foreach ($rezarr as $key => $value) {
			$tp_colusers = New Template;
			$tp_colusers->get_tpl('templates/colusers.tpl');
			$arr_users = get_user_vk($value["player"], $connectEDB);
			$tp_colusers->set_value('USERSSID', $value["player"] . $trid);
			$tp_colusers->set_value('AVATAR_URL', $arr_users->{'response'}[0]->{'photo_50'});
			$tp_colusers->set_value('USERNAME', $arr_users->{'response'}[0]->{'first_name'} . "<BR>" . $arr_users->{'response'}[0]->{'last_name'});
			$tp_colusers->tpl_parse();
			$arr_cols[] = $tp_colusers->html;

		}
	}
	$current_user = col_current_user($connectEDB, $vkid, $trid);
	$arr_cols[] = $current_user;
	$arr_cols = implode($arr_cols);
	//var_dump($arr_cols);
	return $arr_cols;
}
function gets_ssid($connectEDB) {
	$sql = "SELECT * FROM " . TSSID;
	$rez = mysqli_query($connectEDB, $sql);
	$rez = mysqli_fetch_assoc($rez);
	return $rez["us_key"];
}

function get_count_shed($connectEDB, $trid) {
	$sql = "SELECT training, COUNT(*) FROM event_training WHERE training = $trid AND sched=1";
	$rez = mysqli_query($connectEDB, $sql);
	$rez = mysqli_fetch_assoc($rez);
	return $rez["COUNT(*)"];
}
function col_current_user($connectEDB, $vkid, $trid) {
	$sql = "SELECT * FROM " . TUSERS . " WHERE id_vk=$vkid";
	$rez = mysqli_query($connectEDB, $sql);

	$rez = mysqli_fetch_assoc($rez);

	$tp_curr_us = New Template;
	$tp_curr_us->get_tpl('templates/current_coluser.tpl');
	$tp_curr_us->set_value('USERSSID', $vkid . $trid);
	$tp_curr_us->set_value('AVATAR_URL', $rez["avatar"]);
	$tp_curr_us->set_value('USERNAME', $rez['first_name'] . "<BR>" . $rez['last_name']);
	$tp_curr_us->tpl_parse();

	return $tp_curr_us->html;
}
?>