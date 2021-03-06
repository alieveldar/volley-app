<?php
require_once 'conf/config.php';
require_once 'lib/template.php';
$current_user;
function get_alltraining($connectEDB, $vkid) {

	$week = array();
	$day_name = '';

	for ($i = 1; $i <= 7; $i++) {
		$day = $i;
		/*
					$sql_find_training = "SELECT training.day_of_week, training_level.description, volley_room.adress, training.start_time, training.capacity, trainer.first_name, trainer.last_name, trainer.tel, volley_room.ya_map,volley_room.image, training.date, training.price, training_level.intensity, training.id
			FROM training, volley_room, training_level, trainer
		*/
		$sql_find_training = "SELECT * FROM all_training WHERE (day=$day AND arch='0') ORDER BY start_time";
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
			$week["воскресенье"] = mysqli_query($connectEDB, $sql_find_training);
			break;
		}
	}

	return td_and_modal($week, $connectEDB, $vkid);
}

function td_and_modal($week, $connectEDB, $vkid) {
	$adminbutton = get_admin_button($connectEDB, $vkid);
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
		if ($value->num_rows > 0) {

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
				//$date = date_format(new DateTime($my["date"]), 'd-m-Y ');
				$date = $my["date"];
				$price = $my["price"];
				$training_desc = $my["description"];
				$intensity = $my["intensity"];
				$start_time = substr($my["start_time"], 0, -3);
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
				} elseif ($sched == 3) {
					$schedbutton = "Отписаться";
				}
				$tp_modal->set_value('sched', $sched);
				$tp_modal->set_value('schedbutton', $schedbutton);
				$tp_col->set_value('CELL_ID', $cell_id);
				$tp_col->set_value('IMAGE_URL', $image_url);
				$tp_col->set_value('INTENSITY', $intensity);
				$tp_col->set_value('ADRESS', $adress);
				$tp_col->set_value('START_TIME', $start_time);
				$tp_col->set_value('CAPACITY', $capacity);
				$shed_users = get_shed_users($my["id"], $connectEDB, $vkid);
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
	}

	$result[] = implode($rez_row);
	$result[] = implode($rez_mod);
	return $result;
}
function get_search_friends($connectEDB) {
	$tp_add_friends_modal = new Template;
	$tp_add_friends_modal->get_tpl('templates/add_friends_modal.tpl');
	$tp_add_friends_modal->set_value('SEARCHING', "searching");
	$tp_add_friends_modal->tpl_parse();
	return $tp_add_friends_modal->html;
}
function get_ssid($connectEDB) {
	$sql = "SELECT * FROM " . TSSID;
	$rez = mysqli_query($connectEDB, $sql);
	$rez = mysqli_fetch_assoc($rez);
	return $rez["us_key"];
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
function sched_user($vkid, $trid, $connectEDB, $referer) {
	$count = get_count_shed($connectEDB, $trid);
	$capacity = get_training_capacity($connectEDB, $trid);
	if ($count >= ($capacity)) {
		$shed_es = 3;
	} else {
		$shed_es = 1;
	}
	$req_sql1 = "INSERT INTO event_training (training,player,sched,referer) VALUES ($trid,$vkid,'$shed_es','$referer')";
	$rez_sched = mysqli_query($connectEDB, $req_sql1);
	if ($rez_sched) {
		return 1;
	} else {
		return mysqli_error($connectEDB);
		//return $req_sql;
	}
}
function update_field($table = "event_training", $req_field, $value, $condition_field, $condition_value, $connectEDB) {
	if ($value === 1) {
		$trid = $condition_value[1];

		$count = get_count_shed($connectEDB, $trid);
		$capacity = get_training_capacity($connectEDB, $trid);

		if ($count >= $capacity) {
			$value = 3;
		} else {
			$value = 1;
		}
	}

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
	$sql = "SELECT * FROM " . TUSERS . " WHERE id_vk=$vkid";
	$rez = mysqli_query($connectEDB, $sql);
	$rez = mysqli_fetch_assoc($rez);
	//sleep(1);
	/*
				$vk_user_data = json_decode(file_get_contents("https://api.vk.com/method/users.get?user_ids=" . $vkid . "&fields=first_name,last_name,photo_50&access_token=" . $ssid . "&v=5.87"));
	*/
	//return $vk_user_data;
	return $rez;
}
function get_shed_users($trid, $connectEDB, $vkid) {
	global $current_user;
	$rezarr = array();
	$users_sql = "SELECT * FROM event_training WHERE training = $trid AND sched != 2 ORDER BY id";
	$rez = mysqli_query($connectEDB, $users_sql);
	//$rez = mysqli_fetch_assoc($rez);

	foreach ($rez as $value) {
		$rezarr[] = $value;
	}
	$arr_cols = array();

	if ($rez != NULL) {
		foreach ($rezarr as $key => $value) {
			if ($value["sched"] == 1) {
				$reservestyle = "display: none;";
			} else {
				$reservestyle = "";
			}
			if ($value["sched"] == 3) {
				$table = 'event_training';
				$req_field = "sched";
				$condition_value = array();
				$condition_field = array();
				$condition_field[] = "player";
				$condition_field[] = "training";
				$condition_value[] = $value["player"];
				$condition_value[] = $trid;
				$value_key = 1;

				update_field($table, $req_field, $value_key, $condition_field, $condition_value, $connectEDB);
			}
			$removefriend = "";
			if ($value['referer'] == $vkid) {
				$removefriend = '<a class="removefriend" href="#" data-trid="' . $value['training'] . '"' . 'data-vkid="' . $value['player'] . '"' . 'data-referer="' . $vkid . '"' . '>Отписать</a>';
			}
			$tp_colusers = New Template;
			$tp_colusers->get_tpl('templates/colusers.tpl');
			$arr_users = get_user_vk($value["player"], $connectEDB);
			$tp_colusers->set_value('USERSSID', $value["player"] . $trid);
			$tp_colusers->set_value('AVATAR_URL', $arr_users["avatar"]);
			$tp_colusers->set_value('USERNAME', $arr_users['first_name'] . "<BR>" . $arr_users['last_name']);
			$tp_colusers->set_value('RESERVESTYLE', $reservestyle);
			$tp_colusers->set_value('REMOVEFRIEND', $removefriend);
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
	$sql = "SELECT training, COUNT(*) FROM event_training WHERE training = '$trid' AND sched='1'"; //OR sched='3'";
	$rez = mysqli_query($connectEDB, $sql);
	$rez = mysqli_fetch_assoc($rez);
	$rez = (integer) $rez["COUNT(*)"];
	return $rez;
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
function get_training_capacity($connectEDB, $trid) {
	$sql = "SELECT capacity FROM training WHERE id = '$trid'";
	$rez = mysqli_query($connectEDB, $sql);
	$rez = mysqli_fetch_assoc($rez);
	$rez = (int) ((string) $rez["capacity"]);
	return $rez;

}
function get_admin_button($connectEDB, $vkid) {
	$sql_find_ad = "SELECT role FROM " . TROOTS . " WHERE id_vk =" . $vkid;
	$result = mysqli_query($connectEDB, $sql_find_ad);
	if (mysqli_num_rows($result) > 0) {
		$adminbutton = '<a href="/adminapp.php">Администрирование</a>';
	} else {

		$adminbutton = '';
	}
	return $adminbutton;
}
function edit_trainer($connectEDB, $id, $name, $lastname, $tel, $vkid, $sex) {
	$sql = "UPDATE " . TTRAINER . " SET first_name = '$name', last_name = '$lastname', tel = '$tel', vk_id = '$vkid', sex = '$sex'  WHERE id = '$id'";
	$result = mysqli_query($connectEDB, $sql);
	if (mysqli_error($connectEDB)) {
		return "DATABASE ERROR!";
	} else {
		return "Запись успешно изменена";
	}

}
function add_trainer($connectEDB, $id, $name, $lastname, $tel, $vkid, $sex) {
	$sql = "INSERT INTO " . TTRAINER . " (first_name,last_name,tel,vk_id,sex) VALUES ('$name','$lastname','$tel','$vkid','$sex')";
	$result = mysqli_query($connectEDB, $sql);
	//return mysqli_error($connectEDB);
	//return $sql;
	if (mysqli_error($connectEDB)) {
		return "DATABASE ERROR! " . $sql . "  " . mysqli_error($connectEDB);
	} else {
		return "Запись успешно внесена";
	}
}
function delete_trainer($connectEDB, $id) {
	$checksql = "SELECT * FROM " . TTRAINER;
	$checkrez = mysqli_query($connectEDB, $checksql);
	if (mysqli_num_rows($checkrez) == 1) {
		return "Невозможно удалить единственную запись, отредактируйте данные";
		exit();
	}
	$sql = "DELETE FROM " . TTRAINER . " WHERE id='$id'";
	$result = mysqli_query($connectEDB, $sql);
	if (mysqli_error($connectEDB)) {
		return "DATABASE ERROR!";
	} else {
		return "Запись успешно удалена";
	}
}
/////
function edit_unit($connectEDB, $fields, $columns, $table, $id) {
	$set_string = function ($fields, $columns) {
		$count = 0;
		$set_str = array();
		foreach ($fields as $field) {
			$set_str[] = $field . " = " . "'" . addcslashes($columns[$count], "'") . "'";
			$count++;
		}
		return implode(",", $set_str);
	};
	$sql = "UPDATE " . $table . " SET " . $set_string($fields, $columns) . " WHERE id='$id'";
	$result = mysqli_query($connectEDB, $sql);
	if (mysqli_error($connectEDB)) {
		return "DATABASE ERROR!" . /*mysqli_error($connectEDB);*/$sql . var_dump($fields);
	} else {
		return "Запись успешно изменена";
	}
}

function add_unit($connectEDB, $fields, $columns, $table) {
	$insert_string = function ($fields, $columns, $connectEDB) {
		$count = 0;
		$set_columns = array();
		foreach ($fields as $field) {
			$set_columns[] = "'" . addcslashes($columns[$count], "'") . "'";
			$count++;
		}
		$rez = implode(",", $set_columns);
		//$rez = mysqli_real_escape_string($connectEDB, $rez);
		return $rez;
	};
	$sql = "INSERT INTO " . $table . " (" . (implode(",", $fields)) . ") VALUES ( " . $insert_string($fields, $columns, $connectEDB) . ")";

	$result = mysqli_query($connectEDB, $sql);
	//return mysqli_error($connectEDB);
	//return $sql;

	if (mysqli_error($connectEDB)) {
		return "DATABASE ERROR! " . $sql . "  " . mysqli_error($connectEDB);
	} else {
		return "Запись успешно внесена";
	}
}

function del_unit($connectEDB, $id, $table) {
	$checksql = "SELECT * FROM " . $table;
	$checkrez = mysqli_query($connectEDB, $checksql);
	if (mysqli_num_rows($checkrez) == 1) {
		return "Невозможно удалить единственную запись, отредактируйте данные";
		exit();
	}
	//$sql = "DELETE FROM " . $table . " WHERE id='$id'";
	$sql = "UPDATE $table SET arch='1' WHERE id='$id'";
	$result = mysqli_query($connectEDB, $sql);
	if (mysqli_error($connectEDB)) {
		return "DATABASE ERROR!";
	} else {
		return "Запись успешно удалена";
	}
}
function del_unit_training($connectEDB, $id) {
	//$sql = "DELETE FROM event_training WHERE training='$id'";
	$sql = "UPDATE event_training SET arch='1' WHERE id='$id'";
	$rez = mysqli_query($connectEDB, $sql);
}
function get_news($connectEDB) {
	$sql = "SELECT * FROM news";
	$rez = mysqli_query($connectEDB, $sql);
	while ($value = mysqli_fetch_assoc($rez)) {
		$newsarr[] = $value['text'];
	}
	return implode($newsarr);
}
function del_mess_list_group($connectEDB, $id) {
	$sql = "DELETE FROM messages_list WHERE message_group='$id'";
	$rez = mysqli_query($connectEDB, $sql);
	if (mysqli_error($connectEDB)) {
		return "DATABASE ERROR!";
	} else {
		return "Группа успешно изменена";
	}
}
function edit_mess_group($connectEDB, $id, $vkids) {
	$vkids = explode(",", $vkids);
	foreach ($vkids as $vkid) {
		if ($vkid != "") {
			$sql = "INSERT INTO messages_list (message_group, member) VALUES ('$id', '$vkid')";
			$rez = mysqli_query($connectEDB, $sql);
			if (mysqli_error($connectEDB)) {
				return "DATABASE ERROR!";
			}
		}
	}
	return "Группа успешно изменена";
}
function edit_mess_group_name($connectEDB, $id, $groupname) {
	$sql = "SELECT name FROM message_group WHERE id='$id'";
	$rez = mysqli_query($connectEDB, $sql);
	$rez = mysqli_fetch_assoc($rez);
	if ($rez['name'] == $groupname) {
	} else {
		$sql = "UPDATE message_group SET name='$groupname' WHERE id='$id'";
		$rez = mysqli_query($connectEDB, $sql);

	}
}

function add_mess_group($connectEDB, $groupname, $vkids) {
	$sql = "INSERT INTO message_group (name) VALUES ('$groupname')";
	$rez = mysqli_query($connectEDB, $sql);
	if (mysqli_error($connectEDB)) {
		return "DATABASE ERRROR";
	} else {
		add_message_list($connectEDB, $groupname, $vkids);

	}
	return "Группа рассылки создана";
}
function add_message_list($connectEDB, $groupname, $vkids) {
	$sql = "SELECT * FROM message_group WHERE name='$groupname'";
	$rez = mysqli_query($connectEDB, $sql);
	if (mysqli_error($connectEDB)) {
		return "DATABASE ERROR";
	} else {
		$rez = mysqli_fetch_assoc($rez);
		$id = $rez['id'];
		$vkids = explode(",", $vkids);
		foreach ($vkids as $vkid) {
			if ($vkid != "") {
				$sql = "INSERT INTO messages_list (message_group, member) VALUES ('$id', '$vkid')";
				$rez = mysqli_query($connectEDB, $sql);
				if (mysqli_error($connectEDB)) {
					return "DATABASE ERROR!";
				}
			}
		}
	}

}
function del_mess_group($connectEDB, $id) {
	$chksql = "SELECT * FROM message_group";
	$rez = mysqli_query($connectEDB, $chksql);
	if ($rez->num_rows > 1) {
		$sql = "DELETE FROM message_group WHERE id='$id'";
		$rez = mysqli_query($connectEDB, $sql);
		if (mysqli_error($connectEDB)) {
			return "DATABASE ERROR";
		} else {
			return "Группа успешно удалена";
		}
	} else {
		return "Пользователи удалены";
	}
}
function send_group_message($connectEDB, $trainingid, $message, $flag) {
	global $sevretmessagekey;
	if ($flag == 1) {
		$sql = "SELECT * FROM event_training WHERE training='$trainingid' AND sched='1' OR sched='3'";
		$rez = mysqli_query($connectEDB, $sql);
		$vkusers = array();
		while ($value = mysqli_fetch_assoc($rez)) {
			$vkusers[] = $value['player'];
		}
		$vkids = implode(",", $vkusers);
		$key = $sevretmessagekey;
		return send_message_vk($key, $vkids, $message);
	} else {
		$sql = "SELECT * FROM messages_list WHERE message_group='$trainingid'";
		$rez = mysqli_query($connectEDB, $sql);
		$vkusers = array();
		while ($value = mysqli_fetch_assoc($rez)) {
			$vkusers[] = $value['member'];
		}
		$vkids = implode(",", $vkusers);
		$key = $sevretmessagekey;
		return send_message_vk($key, $vkids, $message);
	}
}

function send_message_vk($key, $vkids, $message) {
	$random_id = random_int(1, 4294967295);
	$message_send_result = json_decode(file_get_contents("https://api.vk.com/method/messages.send?random_id=" . $random_id . "&user_ids=" . $vkids . "&message=" . $message . "&access_token=" . $key . "&v=5.87"));
	return $message_send_result;
	//return $message;
}
function check_player_intruding($connectEDB, $vkid, $trid) {
	$sql_all_training = "SELECT * FROM all_training WHERE id='$trid'";
	$rez_all_training = mysqli_query($connectEDB, $sql_all_training);
	$rez_all_training = mysqli_fetch_assoc($rez_all_training);
	$tr_date = $rez_all_training['date'];
	$tr_time = $rez_all_training['start_time'];
	$tr_time = ((integer) (str_replace(":", "", $tr_time)) / 100);
	$sql_all_player = "SELECT * FROM all_player WHERE player='$vkid' AND date='$tr_date' AND (sched='1' OR sched='3')";
	$rez_all_player = mysqli_query($connectEDB, $sql_all_player);
	if ($rez_all_player->num_rows > 0) {
		while ($value = mysqli_fetch_assoc($rez_all_player)) {
			$time = $value['start_time'];
			$time = ((integer) (str_replace(":", "", $time)) / 100);
			if ($tr_time - $time < 200 && $tr_time - $time > -200) {
				return 1;
				exit();
			}
		}
	}
	return 0;
}
function search_friends_vk($connectEDB, $vkid, $reqtemplate, $trid) {
	$reqtemplate = str_replace(" ", "", $reqtemplate);
	$access_token = get_ssid($connectEDB);
	$uri = "https://api.vk.com/method/friends.search?user_id=$vkid&q=$reqtemplate&fields=photo_50&count=1000&access_token=$access_token&v=5.87A";
	if ($friends = json_decode(file_get_contents($uri), true)) {
		$friend_arr = array();
		foreach ($friends["response"]["items"] as $value) {
			$name = $value['first_name'];
			$last_name = $value['last_name'];
			$avatar = $value['photo_50'];
			$uservkid = $value['id'];
			$friend_arr[] = '<li class="list-group-item"><img src="' . $avatar . '"' . 'class="rounded-circle" style="width: 30px; height: 30px; margin:8px">' . $name . " " . $last_name . '<a class="addfriend" href="#" data-referer="' . $vkid . '" data-trid="' . $trid . '" data-vkid="' . $uservkid . '" title="Записать друга на тренировку">Записать друга</a></li>';
		}
	} else {
		return $uri;
		die();}
	return implode($friend_arr);
}
function add_friend_to_userlist($connectEDB, $vkid) {
	$sql_find_user = "SELECT * FROM users WHERE id_vk='$vkid'";
	if (mysqli_query($connectEDB, $sql_find_user)->num_rows == 0) {
		$access_token = gets_ssid($connectEDB);
		$role = 0;
		$user_data_db = json_decode(file_get_contents("https://api.vk.com/method/users.get?user_ids=" . $vkid . "&fields=first_name,last_name,contacts,nickname,photo_50,sex,bdate&access_token=" . $access_token . "&v=5.87"), true);
		$sql_querry_add_user = "INSERT INTO " . TUSERS . " (id_vk, first_name, last_name,role, sex, avatar) VALUES (" . $vkid . "," . "'" . $user_data_db["response"][0]["first_name"] . "'" . "," . "'" . $user_data_db["response"][0]["last_name"] . "'" . "," . $role . "," . $user_data_db["response"][0]["sex"] . "," . "'" . $user_data_db["response"][0]["photo_50"] . "'" . ")";

		if (mysqli_query($connectEDB, $sql_querry_add_user)) {

		}
	}
}
function remove_friend_from_training($connectEDB, $trid, $vkid, $referer) {
	$sql = "UPDATE event_training SET sched='2' WHERE training='$trid' AND player='$vkid' AND referer='$referer'";
	if (mysqli_query($connectEDB, $sql)) {
		return "Вы отписали Вашего друга с тренировки";
	} else {
		return "Друг не найден в БД";
	}
}
function check_expiration_day($connectEDB, $vkid, $trid) {
	$sql = "SELECT * FROM all_training WHERE id='$trid'";
	$rez = mysqli_query($connectEDB, $sql);
	$rez = mysqli_fetch_assoc($rez);
	$tr_date = $rez["date"];
	$tr_time = ((integer) (str_replace(":", "", $rez["start_time"])) / 100);
	$current_date = date('Y-m-d');
	$current_time = ((integer) date('Gi'));
	if ($tr_date === $current_date) {
		if (($current_time - $tr_time > -200)) {
			return 1;
			exit();
		}
	}
	$date_check = (strtotime($current_date) - strtotime($tr_date));	
	if ($date_check > 0) {
		return 1;
		exit();
	}
	return 0;
}
function get_train_users($connectEDB, $trid) {
	$sql = "SELECT * FROM all_player WHERE trid='$trid'";
	$rez = mysqli_query($connectEDB, $sql);
	$person_arr = array();
	while ($value = mysqli_fetch_assoc($rez)) {
		$checked = "";
		$first_name = $value['first_name'];
		$last_name = $value['last_name'];
		$avatar = $value['avatar'];
		$uservkid = $value['player'];
		if ($value['intruder']) {
			$checked = "checked";
		}
		$person_arr[] = '<input class="users_list" type="checkbox" ' . $checked . ' data-vkid=' . $uservkid . '><img src="' . $avatar . '"' . 'class="rounded-circle" style="width: 30px; height: 30px; margin:8px">' . $first_name . ' ' . $last_name . '<hr></hr>';
	}
	return implode($person_arr);
	//return $sql;
}
function check_intruders($connectEDB, $trid, $vkid) {
	$sql = "UPDATE event_training SET intruding='0' WHERE training ='$trid'";
	$rez = mysqli_query($connectEDB, $sql);
	$vkid = explode(",", $vkid);
	foreach ($vkid as $value) {
		$sql = "UPDATE event_training SET intruding='1' WHERE (training ='$trid' AND player='$value')";
		$rez = mysqli_query($connectEDB, $sql);
	}
	return "Подписчики отмечены как пропутившие тренировку";
}