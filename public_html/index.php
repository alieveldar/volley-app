<?php
require_once "lib/template.php";
require_once "conf/config.php";
require_once "lib/dbq.php";
session_start();
session_id($_GET["PHPSESSID"]);

$trainings = get_alltraining($connectEDB);
$td = $trainings[0];


$tpl->get_tpl('templates/first.tpl');
$tpl->set_value('TRAINING_ROOM_TABLE', $td);
$tpl->tpl_parse();
echo $tpl->html;
//$trainings = get_alltraining($connectEDB);
//echo $trainings[0];
//echo $trainings[1];
//var_dump($trainings[0]);
//var_dump($trainings[1]);

//echo "<BR>" . $trainings["adress"];

//echo $trainings["среда"]->{"num_rows"};


?>