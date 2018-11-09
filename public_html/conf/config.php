<?php
const TNEWS               = 'news';
const TROOTS              = 'roots';
const TTRAINER            = 'trainer'; 
const TTRAINING           = 'training'; 
const TTRAINIG_LEVEL      = 'training_level' ;
const TTRAINIG_REP        = 'training_repeatability';
const TUSERS              = 'users'; 
const TVKFRIENDS          = 'vkfriends'; 
const TVOLLEY_ROOM        = 'volley_room'; 
 $dbservice  = array(
 'dbhost' => 'lvh.me',
 'dbname' =>'eDb',
 'dbuser' => 'volleyadmin',
 'dbpassword' => 'volley2018'
);
$connectEDB = mysqli_connect($dbservice['dbhost'],$dbservice['dbuser'],$dbservice['dbpassword'], $dbservice['dbname']);
?>