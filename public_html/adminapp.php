<?php
require_once 'lib/template.php';
require_once 'lib/adminbd.php';
require_once 'conf/config.php';
$trainers = get_trainers($connectEDB);
$level = get_level($connectEDB);
$admin_tpl = New Template;
$admin_tpl->get_tpl('templates/admin.tpl');
$admin_tpl->set_value('TABLETRAINERS', $trainers[0]);
$admin_tpl->set_value('TRAINERMODALS', $trainers[1]);
$admin_tpl->set_value('TABLELEVEL', $level[0]);
$admin_tpl->set_value('LEVELMODALS', $level[1]);
$admin_tpl->tpl_parse();
echo $admin_tpl->html;

?>