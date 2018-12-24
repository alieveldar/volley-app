<?php
session_start();
require_once "lib/template.php";
require_once "lib/dbq.php";
$vkid = $_GET['vkid'];
$adminbutton = get_admin_button($connectEDB, $vkid);
$trainings = get_alltraining($connectEDB, $vkid);
$findFriends = get_search_friends($connectEDB);
$news = get_news($connectEDB);
$first_tpl = New Template;
$first_tpl->get_tpl('templates/first.tpl');
$first_tpl->set_value('TRAINING_ROOM_TABLE', $trainings[0]);
$first_tpl->set_value('MODAL', $trainings[1]);
$first_tpl->set_value('ADMINBUTTON', $adminbutton);
$first_tpl->set_value('NEWS', $news);
$first_tpl->set_value('FINDFRIENDS', $findFriends);
$first_tpl->tpl_parse();
echo $first_tpl->html;
?>