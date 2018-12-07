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