<?php
//require_once "lib/template.php";
require_once "conf/config.php";
session_start();
session_id($_GET["PHPSESSID"]);
var_dump($_SESSION);
echo "Session ID: ".session_id();
echo "<BR> ".session_name();


?>