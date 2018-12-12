<?php
require_once 'conf/config.php';
require_once 'lib/template.php';
function get_trainers($connectEDB) {

	$sql = "SELECT * FROM " . TTRAINER . " WHERE 1";
	$rez = mysqli_query($connectEDB, $sql);
	$trainersarr = array();
	$trainersmod = array();
	while ($value = mysqli_fetch_assoc($rez)) {
		$id = $value['id'];
		$firstname = $value['first_name'];
		$lastname = $value['last_name'];
		$tel = $value['tel'];
		$vkid = $value['vk_id'];
		$button = '<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#' . "edit_tr$id" . '"' . '>Редактировать</button>';
		$trainers_tr = "<tr><td>$firstname</td><td>$lastname</td><td>$button</td></tr>";
		$trainersarr[] = $trainers_tr;
		$tp_add_trainer = new Template;
		$tp_add_trainer->get_tpl('templates/add_trainer.tpl');
		$tp_add_trainer->set_value('ID', $id);
		$tp_add_trainer->set_value('TRFIRSTNAME', $firstname);
		$tp_add_trainer->set_value('TLASTNAME', $lastname);
		$tp_add_trainer->set_value('TTEL', $tel);
		$tp_add_trainer->set_value('TVKID', $vkid);
		$tp_add_trainer->tpl_parse();
		$trainersmod[] = $tp_add_trainer->html;
	}
	$trainersarr = implode($trainersarr);
	$trainersmod = implode($trainersmod);
	return array($trainersarr, $trainersmod);
}
function get_level($connectEDB) {
	$sql = "SELECT * FROM " . TTRAINING_LEVEL;
	$rez = mysqli_query($connectEDB, $sql);
	$levelsarr = array();
	$levelsmod = array();
	while ($value = mysqli_fetch_assoc($rez)) {
		$id = $value['id'];
		$description = $value['description'];
		$intensity = $value['intensity'];
		$button = '<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#' . "edit_level$id" . '"' . '>Редактировать</button>';
		$level_tr = "<tr><td>$intensity</td><td>$button</td></tr>";
		$levelsarr[] = $level_tr;
		$tp_add_level = new Template;
		$tp_add_level->get_tpl('templates/add_level.tpl');
		$tp_add_level->set_value('LEVINTENSITY', $intensity);
		$tp_add_level->set_value('LEVDESC', $description);
		$tp_add_level->set_value('ID', $id);
		$tp_add_level->tpl_parse();
		$levelsmod[] = $tp_add_level->html;
	}
	$levelsarr = implode($levelsarr);
	$levelsmod = implode($levelsmod);
	return array($levelsarr, $levelsmod);
}
function get_room($connectEDB) {
	$sql = "SELECT * FROM " . TVOLLEY_ROOM;
	$rez = mysqli_query($connectEDB, $sql);
	$roomsarr = array();
	$roomsmod = array();
	while ($value = mysqli_fetch_assoc($rez)) {
		$id = $value['id'];
		$roomname = $value['name'];
		$roomcity = $value['city'];
		$roomadress = $value['adress'];
		$roomimage = $value['image'];
		$roomiya = $value['ya_map'];
		$button = '<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#' . "edit_room$id" . '"' . '>Редактировать</button>';
		$room_tr = "<tr><td>$roomname</td><td>$button</td></tr>";
		$roomsarr[] = $room_tr;
		$tp_add_room = new Template;
		$tp_add_room->get_tpl('templates/add_room.tpl');
		$tp_add_room->set_value('ROOMNAME', $roomname);
		$tp_add_room->set_value('ROOMCITY', $roomcity);
		$tp_add_room->set_value('ROOMADRESS', $roomadress);
		$tp_add_room->set_value('ROOMIMAGE', $roomimage);
		$tp_add_room->set_value('ROOMIYA', $roomiya);
		$tp_add_room->set_value('ID', $id);
		$tp_add_room->tpl_parse();
		$roomsmod[] = $tp_add_room->html;
	}
	$roomsarr = implode($roomsarr);
	$roomsmod = implode($roomsmod);
	return array($roomsarr, $roomsmod);
}
function get_root($connectEDB) {
	$sql = "SELECT * FROM " . TROOTS;
	$rez = mysqli_query($connectEDB, $sql);
	$rootsarr = array();
	$rootsmod = array();
	while ($value = mysqli_fetch_assoc($rez)) {
		$id = $value['id'];
		$rootname = $value['first_name'];
		$rootsurname = $value['last_name'];
		$rootidvk = $value['id_vk'];
		$button = '<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#' . "edit_root$id" . '"' . '>Редактировать</button>';
		$root_tr = "<tr><td>$rootname</td><td>$rootsurname</td><td>$button</td></tr>";
		$rootsarr[] = $root_tr;
		$tp_add_root = new Template;
		$tp_add_root->get_tpl('templates/add_root.tpl');
		$tp_add_root->set_value('ROOTNAME', $rootname);
		$tp_add_root->set_value('ROOTSURNAME', $rootsurname);
		$tp_add_root->set_value('ROOTIDVK', $rootidvk);
		$tp_add_root->set_value('ID', $id);
		$tp_add_root->tpl_parse();
		$rootsmod[] = $tp_add_root->html;
	}
	$rootsarr = implode($rootsarr);
	$rootsmod = implode($rootsmod);
	return array($rootsarr, $rootsmod);
}
function get_news($connectEDB) {
	$sql = "SELECT * FROM " . TNEWS;
	$rez = mysqli_query($connectEDB, $sql);
	$rootsarr = array();
	$rootsmod = array();
	while ($value = mysqli_fetch_assoc($rez)) {
		$id = $value['id'];
		$newstext = $value['text'];
		$button = '<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#' . "edit_news$id" . '"' . '>Редактировать</button>';
		$root_tr = "<tr><div class= " . "col-8" . "><td>$newstext</td></div><td><div class=" . "col-4" . "> $button</div></td></tr>";
		$newsarr[] = $root_tr;
		$tp_add_news = new Template;
		$tp_add_news->get_tpl('templates/add_news.tpl');
		$tp_add_news->set_value('NEWS', $newstext);
		$tp_add_news->set_value('ID', $id);
		$tp_add_news->tpl_parse();
		$newsmod[] = $tp_add_news->html;
	}
	$newsarr = implode($newsarr);
	$newsmod = implode($newsmod);
	return array($newsarr, $newsmod);
}
function get_trainings($connectEDB) {

	$sql = "SELECT * FROM all_training";
	$rez = mysqli_query($connectEDB, $sql);
	$trainingsarr = array();
	$trainingsmodal = array();
	while ($value = mysqli_fetch_assoc($rez)) {
		$id = $value['id'];
		$price = $value['price'];
		$day_week = $value['dayname'];
		$name_training = $value['intensity'];
		$adress = $value['adress'];
		$time_start = $value['start_time'];
		$dates = $value['date'];
		$date = new DateTime($value['date']);
		$date = date_format($date, 'd-m-y');
		$capacity = $value['capacity'];
		$trname = $value['first_name'] . " " . $value['last_name'];
		$button = '<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#' . "edit_training$id" . '"' . '>Редактировать</button>';
		$training_tr = "<tr><td>$day_week</td><td>$name_training</td><td>$adress</td><td>$time_start</td><td>$date</td><td>$capacity</td><td>$button</td></tr>";
		$trainingsarr[] = $training_tr;
		$tp_add_trainings = new Template;
		$tp_add_trainings->get_tpl('templates/add_training.tpl');
		$tp_add_trainings->set_value('ID', $id);
		$tp_add_trainings->set_value('TRPRICE', $price);
		$tp_add_trainings->set_value('TRCAPACITY', $capacity);
		$tp_add_trainings->set_value('TRAINERNAME', $trname);
		$tp_add_trainings->set_value('TRPRICE', $price);
		$tp_add_trainings->set_value('VOLLEYROOM', $adress);
		$tp_add_trainings->set_value('TRPRICE', $price);
		$tp_add_trainings->set_value('WEEKDAY', $day_week);
		$tp_add_trainings->set_value('TRTAIM', $time_start);
		$tp_add_trainings->set_value('TRAININGLEVEL', $name_training);
		$tp_add_trainings->set_value('TRAININGDATE', $dates);
		$tp_add_trainings->set_value('TRAINERS', get_key_value($connectEDB, "trainer", array("id", "first_name")));
		$tp_add_trainings->set_value('VOLLEYROOMS', get_key_value($connectEDB, "volley_room", array("id", "adress")));
		$tp_add_trainings->set_value('WEEKDAYS', get_key_value($connectEDB, "week_day", array("id", "dayname")));
		$tp_add_trainings->set_value('TRAININGLEVELS', get_key_value($connectEDB, "training_level", array("id", "intensity")));
		$tp_add_trainings->tpl_parse();
		$trainingsmodal[] = $tp_add_trainings->html;
	}
	$trainingsmodal = implode($trainingsmodal);
	$trainingsarr = implode($trainingsarr);
	return array($trainingsarr, $trainingsmodal);
}
function get_key_value($connectEDB, $table, $fields) {
	$fieldsql = implode(",", $fields);
	$sql = "SELECT $fieldsql FROM $table";
	$rez = mysqli_query($connectEDB, $sql);
	$tr_arr = array();
	while ($value = mysqli_fetch_assoc($rez)) {
		$id = $value['id'];
		$name = $value[$fields[1]];
		$tr_arr[] = "<option value=$id>$name</option>";
	}
	//var_dump($tr_arr);
	return implode($tr_arr);
}
