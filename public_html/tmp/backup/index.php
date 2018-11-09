<?php
require "template.php";
require "config.php";
require 'tester.php';

$conn = mysqli_connect($dbhost,$dbuser,$dbpassword, $dbname);
#mysql_select_db($dbname);

$tpl->get_tpl('page.tpl');
$tpl->set_value('TITLE',$title);
$tpl->set_value('DESCRIPTION', $description);

$menu = "
<br>Men1
<br>Men2
<br>Men3";

if (!isset($p)) {
    $page = 'Это переменная главной страницы';
	$tpl->set_value('MENU', $menu);
    $tpl->set_value('PAGE', $page);
}

$tpl->tpl_parse();

echo $tpl->html;
$dbdescription = "'Test description'";
$dbtablename = 'training_level';
$dbintensity = "'very intensity очень интенсивная'";
$sql = "INSERT INTO $dbtablename (description, intensity) VALUES ($dbdescription, $dbintensity)";
$sql2 = "SELECT * FROM $dbtablename";
if (mysqli_query($conn, $sql)){
	echo "INSERT OK";
	}
	else {
		echo "Error" . $sql . "<br>" . mysqli_error($conn);
	}
if ($superselect = mysqli_query($conn, $sql2)){
	echo "SELECT OK" . $sql2 . mysqli_error($conn);
	}
	else {
		echo "Error select" . $sql2 . "<br>" . mysqli_error($conn);
	}
	while ($row = mysqli_fetch_array($superselect)) {
		echo "<tr>";
	echo "<td>$row[id] </td>";
echo "<td> $row[description]</td>";
echo "<td>$row[intensity]</td>";
		echo "<tr>";
	}

mysqli_close($conn);
?>