<?php
const TNEWS = 'news';
const TROOTS = 'roots';
const TTRAINER = 'trainer';
const TTRAINING = 'training';
const TTRAINING_LEVEL = 'training_level';
const TTRAINIG_REP = 'training_repeatability';
const TUSERS = 'users';
const TVKFRIENDS = 'vkfriends';
const TVOLLEY_ROOM = 'volley_room';
const TEVENT_TRAINING = 'event_training';
const TSSID = "ssid";
$dbservice = array(
	'dbhost' => 'lvh.me',
	'dbname' => 'eDb',
	'dbuser' => 'volleyadmin',
	'dbpassword' => 'volley2018',
);
$v = array(
	'client_id' => 6739525, // (обязательно) номер приложения standalone
	'secret_key' => 'Z1G1vY4Hj2fxbG1qkTmA', // (обязательно) standalone
	'user_id' => 12345, // not used
	'scope' => 'offline,friends', // used
	'v' => '5.87',
	'redirect_url' => "https://lvh.me/api.php",
);
$connectEDB = mysqli_connect($dbservice['dbhost'], $dbservice['dbuser'], $dbservice['dbpassword'], $dbservice['dbname']);
mysqli_set_charset($connectEDB, "utf8");
$sevretmessagekey = '8d34934067344b046af7a495c66d780c8935e84ddd5e9844640b31c97764a5a1e92215c101d5326803539'; //ключ сообщества
