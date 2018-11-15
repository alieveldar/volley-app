<?php
require_once "lib/template.php";
require_once "conf/config.php";
require_once "lib/dbq.php";
session_start();
session_id($_GET["PHPSESSID"]);
var_dump($_SESSION);
echo "Session ID: " . session_id();
echo "<BR> " . session_name();

$tpl->get_tpl('templates/first.tpl');
$tpl->tpl_parse();

echo $tpl->html;
$trainings = get_alltraining($connectEDB);
var_dump($trainings);

echo "<BR>" . $trainings["adress"];
?>