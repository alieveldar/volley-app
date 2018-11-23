<?php

session_start();

//session_id($_GET["PHPSESSID"]);
require_once 'lib/template.php';
function get_alltraining($connectEDB) {

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

	return td_and_modal($week);
}

function td_and_modal($week) {
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
			$adress = $my["adress"];
			$capacity = "0/" . $my["capacity"];
			$contacts = "NOT VAR HERE";
			$ya_map = $my["ya_map"];
			$date = $my["date"];
			$price = $my["price"];
			$training_desc = $my["description"];
			$intensity = $my["intensity"];
			$start_time = $my["start_time"];
			$tp_modal->set_value('DAY', $day);
			$tp_modal->set_value('CELL_ID', $cell_id);
			$tp_modal->set_value('ADRESS', $adress);
			$tp_modal->set_value('CAPACITY', $capacity);
			$tp_modal->set_value('CONTACTS', $contacts);
			$tp_modal->set_value('YA_MAP', $ya_map);
			$tp_modal->set_value('DATE', $date);
			$tp_modal->set_value('PRICE', $price);
			$tp_modal->set_value('TRAINING_DESC', $training_desc);
			$tp_modal->set_value('vkid', $_SESSION["vkid"]);
			$tp_modal->set_value('trid', $my["id"]);
			$tp_col->set_value('CELL_ID', $cell_id);
			$tp_col->set_value('IMAGE_URL', $image_url);
			$tp_col->set_value('INTENSITY', $intensity);
			$tp_col->set_value('ADRESS', $adress);
			$tp_col->set_value('START_TIME', $start_time);
			$tp_col->set_value('CAPACITY', $capacity);
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
			# code...

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
function find_by_cond($table, $req_fields, $fields, $rez_field, $connectEDB) {
	$req_sql = "SELECT * FROM " . $table . " WHERE "
		. $req_fields[0] . "=" . $fields[0] . " AND " . $req_fields[1] . "=" . $fields[1];
	$rez = mysqli_query($connectEDB, $req_sql);
	
	$rez1 = mysqli_fetch_assoc($rez);
	//return mysqli_error($rez);
	//return mysqli_error($rez);
	return $rez1;
}
function sched_user ($vkid, $trid, $connectEDB){
	$shed_es = 1;
	$req_sql1 = "INSERT INTO event_training (training,player,sсheduled) VALUES ('$trid','$vkid','$shed_es')";
	$rez_sched = mysqli_query($connectEDB, $req_sql1);
	if ($rez_sched){
		return 1;
	} else {
		return mysqli_error($connectEDB);
		//return $req_sql;
	}
}
?>