<?php
require_once 'conf/config.php';
$datasecret = new stdClass();
$count = 0;
if (isset($_GET['viewer_id'])) {
	global $datasecret;

	$datasecretarr = array("user_id" => $_GET['viewer_id'], "access_token" => get_ssid($connectEDB), "role" => $_GET['viewer_type'], "api_url" => $_GET['api_url']);
	foreach ($datasecretarr as $key => $value) {
		$datasecret->$key = $value;
	}
	check_user($datasecret, $connectEDB);
}

if (isset($_GET['code'])) {
	global $datasecret;
	$datasecret = getAcces($_GET['code'], $v, $connectEDB);
} else {

	$url = "Location: https://oauth.vk.com/authorize?client_id=" . $v["client_id"] . "&display=popup&redirect_uri=" . $v['redirect_url'] . "&scope=" . $v["scope"] . "&response_type=code&v=5.87";

	header($url);
}

function getAcces($code, $arr, $connectEDB) {
	truncate_ssid($connectEDB);
	$v = &$arr;
	$urlacc = "https://oauth.vk.com/access_token?client_id=" . $v["client_id"] . "&client_secret=" . $v["secret_key"] . "&redirect_uri=" . $v['redirect_url'] . "&code=" . $code;
	$datasecret = file_get_contents($urlacc);
	$datasecret = json_decode($datasecret);
	$insert = insert_ssid(($datasecret->{'access_token'}), $connectEDB);
	if ($insert === "OK") {
		check_user($datasecret, $connectEDB);
	} else {
		echo "INSERT TO DATABASE FAIL ";
		echo mysqli_error($connectEDB);
	}

}

function check_user($datasecret, $connectEDB) {

	$user_id = $datasecret->{"user_id"};
	$sql_find_ad = "SELECT role FROM " . TROOTS . " WHERE id_vk =" . $user_id;
	$sql_find_user = "SELECT role FROM " . TUSERS . " WHERE id_vk =" . $user_id;
	$result = mysqli_query($connectEDB, $sql_find_ad);
	if (mysqli_num_rows($result) > 0) {
		$role = mysqli_result_fetch_assoc($result);
		$role = $role->{"role"};
		create_session($datasecret, $role);
	} else {
		if (mysqli_num_rows(mysqli_query($connectEDB, $sql_find_user)) > 0) {
			destroy_user($datasecret, $connectEDB);
		} else {
			add_user($datasecret, $connectEDB);
		}
	}
}

function destroy_user($datasecret, $connectEDB) {

	if (mysqli_query($connectEDB, "DELETE FROM " . TUSERS . " WHERE id_vk=" . $datasecret->{"user_id"})) {

	} else {

	}
	add_user($datasecret, $connectEDB);
}
function add_user($datasecret, $connectEDB) {

	$role = 0;
	$data_db = get_data_vk($datasecret);
	$user_data_db = $data_db["user_data_db"];
	$friends_data_db = $data_db["friends_data_db"];
	$sql_querry_add_user = "INSERT INTO " . TUSERS . " (id_vk, first_name, last_name, age,role, sex, avatar) VALUES (" . $datasecret->{"user_id"} . "," . "'" . $user_data_db->{"response"}[0]->{"first_name"} . "'" . "," . "'" . $user_data_db->{"response"}[0]->{"last_name"} . "'" . "," . "'" . $user_data_db->{"response"}[0]->{"bdate"} . "'" . "," . $role . "," . $user_data_db->{"response"}[0]->{"sex"} . "," . "'" . $user_data_db->{"response"}[0]->{"photo_50"} . "'" . ")";

	if (mysqli_query($connectEDB, $sql_querry_add_user)) {

	} else {

	}
	create_session($datasecret, $role);

}

function get_data_vk($datasecret) {
	$user_data_db = json_decode(file_get_contents("https://api.vk.com/method/users.get?user_ids=" . $datasecret->{"user_id"} . "&fields=first_name,last_name,contacts,nickname,photo_50,sex,bdate&access_token=" . $datasecret->{"access_token"} . "&v=5.87"));

	$friends_data_db = 0; //delete when friends must be entered into the database
	$vk_data_db = array("user_data_db" => $user_data_db, "friends_data_db" => $friends_data_db);

	return $vk_data_db;
}
function create_session($datasecret, $role) {
	global $count;

	global $vkuser;
	if ($role === 0) {
		$sname = "user" . $datasecret->{"user_id"};

	} elseif ($role === 1) {
		$sname = "adm_";

	} elseif ($role === 8) {
		$sname = "god_";

	} else {

	}
	if (session_start()) {

	} else {

	}

	$_SESSION["role"] = $role;
	$_SESSION["vkid"] = $datasecret->{"user_id"};
	$_SESSION["test"] = "TEST";
	$_SESSION["access_token"] = $datasecret->{"access_token"};

	$count++;

}

function Redirect($url, $permanent = false) {
	header('Location: ' . $url, true, $permanent ? 301 : 302);

	exit();
}
function insert_ssid($acc, $connectEDB) {
	$sql = "INSERT INTO " . TSSID . " (us_key) VALUE ('$acc')";

	$rez = mysqli_query($connectEDB, $sql);
	if ($rez) {
		return "OK";
	} else {
		return mysqli_error($connectEDB);
	}
}
function get_ssid($connectEDB) {
	$sql = "SELECT * FROM " . TSSID;
	$rez = mysqli_query($connectEDB, $sql);
	$rez = mysqli_fetch_assoc($rez);
	return $rez["us_key"];
}
function truncate_ssid($connectEDB) {
	$sql = "TRUNCATE TABLE " . TSSID;
	$rez = mysqli_query($connectEDB, $sql);
	return $rez;
}

$url = "/index.php?PHPSESSID=" . session_id();
if (($count === 1) & $_SESSION["test"] === "TEST") {
	Redirect($url);
}

?>

