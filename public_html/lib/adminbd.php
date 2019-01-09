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
	$sql = "SELECT * FROM " . TTRAINING_LEVEL . " WHERE arch='0'";
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
	$sql = "SELECT * FROM " . TVOLLEY_ROOM . " WHERE arch='0'";
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
	$sql = "SELECT * FROM " . TROOTS . " WHERE arch='0'";
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
	$sql = "SELECT * FROM " . TNEWS . " WHERE arch='0'";
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

	$sql = "SELECT * FROM all_training WHERE arch='0' ORDER BY day";
	$rez = mysqli_query($connectEDB, $sql);
	$trainingsarr = array();
	$trainingsmodal = array();
	$trainingsmessages = array();
	while ($value = mysqli_fetch_assoc($rez)) {
		$id = $value['id'];
		$price = $value['price'];
		$day_week = $value['dayname'];
		$name_training = $value['intensity'];
		$adress = $value['adress'];
		$time_start = substr($value["start_time"], 0, -3);
		$dates = $value['date'];
		$date = new DateTime($value['date']);
		$date = date_format($date, 'd-m-y');
		$capacity = $value['capacity'];
		$trname = $value['first_name']; //. " " . $value['last_name'];
		$trainer_id = $value['trainer_id'];
		$volley_room_id = $value['room_id'];
		$intensity_id = $value['training_intesid'];
		$button = '<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#' . "edit_training$id" . '"' . '>Редактировать</button>';
		$messagebutton = '<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#' . "training_message$id" . '"' . '>Сообщение</button>';
		$buttontrainusers = '<button type="button" class="btn btn-light check_users" data-toggle="modal" data-trid="' . $id . '" data-target="#add_part" style="margin: 5px 0px 0px 0px;">Участники</button>';
		$training_tr = "<tr><td>$day_week</td><td>$name_training</td><td>$adress</td><td>$time_start</td><td>$date</td><td>$capacity</td><td>$button</td><td>$messagebutton<div>$buttontrainusers</div></td></tr>";
		$trainingsarr[] = $training_tr;
		$tp_add_trainings = new Template;
		$tp_add_messages = new Template;
		$tp_add_messages->get_tpl('templates/add_train_message.tpl');
		$tp_add_messages->set_value('ID', $id);
		$tp_add_trainings->get_tpl('templates/add_training.tpl');
		$tp_add_trainings->set_value('ID', $id);
		$tp_add_trainings->set_value('TRAINERID', $trainer_id);
		$tp_add_trainings->set_value('VOLLEYID', $volley_room_id);
		$tp_add_trainings->set_value('LEVELID', $intensity_id);
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
		$tp_add_messages->tpl_parse();
		$trainingsmodal[] = $tp_add_trainings->html;
		$trainingsmessages[] = $tp_add_messages->html;

	}
	$trainingsmodal = implode($trainingsmodal);
	$trainingsarr = implode($trainingsarr);
	$trainingsmessages = implode($trainingsmessages);
	return array($trainingsarr, $trainingsmodal, $trainingsmessages);
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

function get_messgroup($connectEDB) {
	$sql = "SELECT * FROM message_group";
	$groupsarr = array();
	$groupsmodal = array();
	$groupmessarr = array();
	$rez = mysqli_query($connectEDB, $sql);
	while ($value = mysqli_fetch_assoc($rez)) {
		$id = $value['id'];
		$name = $value['name'];
		$count = get_msgroup_count($connectEDB, $id);
		$button = '<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#' . "edit_messgroup$id" . '"' . '>Редактировать</button>';
		$messagebutton = '<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#' . "group_message$id" . '"' . '>Сообщение</button>';
		$groupsarr[] = "<tr><td>$name</td><td>$count</td><td>$button</td><td>$messagebutton</td></tr>";
		$groupusers = get_group_users($connectEDB, $id);
		$tp_add_groups = new Template;
		$tp_add_group_mess = new Template;
		$tp_add_groups->get_tpl('templates/add_group.tpl');
		$tp_add_group_mess->get_tpl('templates/add_message.tpl');
		$tp_add_groups->set_value('ID', $id);
		$tp_add_groups->set_value('GROUPNAME', $name);
		$tp_add_groups->set_value('ID', $id);
		$tp_add_groups->set_value('GROUPUSERS', $groupusers);
		$tp_add_group_mess->set_value('ID', $id);
		$tp_add_group_mess->tpl_parse();
		$tp_add_groups->tpl_parse();
		$groupsmodal[] = $tp_add_groups->html;
		$groupmessarr[] = $tp_add_group_mess->html;
	}
	return array(implode($groupsarr), implode($groupsmodal), implode($groupmessarr));
}

function get_msgroup_count($connectEDB, $id) {
	$sql = "SELECT * FROM messages_list WHERE message_group='$id'";
	$rez = mysqli_query($connectEDB, $sql);
	return $rez->num_rows;
}

function get_group_users($connectEDB, $id) {
	$sql = "SELECT * FROM users ORDER BY first_name";
	$rez = mysqli_query($connectEDB, $sql);
	$groupcheckbox = array();
	while ($value = mysqli_fetch_assoc($rez)) {
		$idvk = $value['id_vk'];
		//$id = $value['id'];
		$avatar = $value['avatar'];
		$first_name = $value['first_name'];
		$last_name = $value['last_name'];
		$group_user = get_mess_group_users($connectEDB, $id, $idvk);
		$checkbox_checked = '<input class="users_list' . $id . '" type="checkbox" checked="checked" data-vkid=' . $idvk . '><img src="' . $avatar . '"' . 'class="rounded-circle" style="width: 30px; height: 30px; margin:8px">' . $first_name . ' ' . $last_name . '<hr></hr>';
		$checkbox_unchecked = '<input class="users_list' . $id . '" type="checkbox"  data-vkid=' . $idvk . '><img src="' . $avatar . '"' . 'class="rounded-circle" style="width: 30px; height: 30px; margin:8px">' . $first_name . ' ' . $last_name . '<hr></hr>';
		if ($group_user > 0) {
			$groupcheckbox[] = $checkbox_checked;
		} else {
			$groupcheckbox[] = $checkbox_unchecked;
		}
	}
	return implode($groupcheckbox);
}

function get_mess_group_users($connectEDB, $id, $idvk) {
	$sql = "SELECT * FROM all_mess WHERE id='$id' AND member='$idvk'";
	$rez = mysqli_query($connectEDB, $sql);
	if ($rez->num_rows > 0) {
		return 1;
	} else {
		return 0;
	}
}
