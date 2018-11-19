<?php
const TNEWS = 'news';
const TROOTS = 'roots';
const TTRAINER = 'trainer';
const TTRAINING = 'training';
const TTRAINIG_LEVEL = 'training_level';
const TTRAINIG_REP = 'training_repeatability';
const TUSERS = 'users';
const TVKFRIENDS = 'vkfriends';
const TVOLLEY_ROOM = 'volley_room';
const TEVENT_TRAINING = 'event_training';
$dbservice = array(
	'dbhost' => 'lvh.me',
	'dbname' => 'eDb',
	'dbuser' => 'volleyadmin',
	'dbpassword' => 'volley2018',
);
$v = array(
	'client_id' => 6739525, // (обязательно) номер приложения
	'secret_key' => 'Z1G1vY4Hj2fxbG1qkTmA', // (обязательно) получить тут https://vk.com/editapp?id=6738467&section=options где 12345 - client_id
	'user_id' => 12345, // ваш номер пользователя в вк
	'scope' => 'wall', // права доступа
	'v' => '5.87',
);
$connectEDB = mysqli_connect($dbservice['dbhost'], $dbservice['dbuser'], $dbservice['dbpassword'], $dbservice['dbname']);

//variables to parse on html
/*
$table_open = '<table><tbody><th>' . $day . '</th>';
$tr_open = '<tr>';
$tr_close = '</tr>';
$table_td = '<div>
    <td class="btn btn-link" data-toggle="modal" data-target="#'.'cell'. $my["id"] . '"' . ' style="display: block; height: 100%;">'.
        $my["intensity"] .
        '</button>
        <div>
            <img src='. '"' .$my["image"]. '"' . 'alt="..." class="rounded-circle" style="width: 75px; height: 75px;">
            <div>
                <p>'. $my["adress"]. '</p>
            </div>
            <div>
                <p>'.$my["start_time"].'</p>
            </div>
            <div>
                <p>'. $my["capacity"] .'</p>
            </div>
    </td>
</div>';

$modal = 
'<div class="modal fade" id="'. 'cell'. $my["id"] . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> '. $day  $my["adress"]  $my["capacity"] . '</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="contacts">'
                    . $contacts .
                    ' </div>
                <div class="room_map">' .
                    $my["ya_map"] . '
                </div>
                <div class="date_cost">'.
                    $my["date"] .
                    $my["price"] .
                    ' </div>
                <div class="training_desc">' .
                    $my["description"] .
                    '</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>';
*/
?>