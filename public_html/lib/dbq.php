<?php
function get_alltraining($connectEDB) {

	$week = array();
	$day_name = '';
	/*
	$sql_find_training = "SELECT training.day_of_week, training_level.description, volley_room.adress, training.start_time, training.capacity, trainer.first_name, trainer.last_name, trainer.tel, volley_room.ya_map, training.date, training.price, training_level.intensity, training.id
FROM training, volley_room, training_level, trainer
WHERE training.day_of_week =" . $day . " AND training.level = training_level.id AND training.volley_room = volley_room.id AND training.trainer = trainer.id";
*/
/*
mysqli_set_charset($connectEDB, "utf8");
$result = mysqli_query($connectEDB, $sql_find_training);
mysqli_data_seek($result, 2);
$result = mysqli_fetch_assoc($result);
 */
	for ($i = 1; $i <= 7; $i++) {
		$day = $i;
		$sql_find_training = "SELECT training.day_of_week, training_level.description, volley_room.adress, training.start_time, training.capacity, trainer.first_name, trainer.last_name, trainer.tel, volley_room.ya_map,volley_room.image, training.date, training.price, training_level.intensity, training.id
FROM training, volley_room, training_level, trainer
WHERE training.day_of_week =" . $day . " AND training.level = training_level.id AND training.volley_room = volley_room.id AND training.trainer = trainer.id";
mysqli_set_charset($connectEDB, "utf8");
		switch ($i) {
		case 1:
			$week["понедельник"] = mysqli_query($connectEDB, $sql_find_training);
			break;
		case 2:
			$week["вторник"] = mysqli_query($connectEDB, $sql_find_training);
			break;
		case 3:
			$week["среда"] = mysqli_query($connectEDB, $sql_find_training);
			break;
		case 4:
			$week["четверг"] = mysqli_query($connectEDB, $sql_find_training);
			break;
		case 5:
			$week["пятница"] = mysqli_query($connectEDB, $sql_find_training);
			break;
		case 6:
			$week["суббота"] = mysqli_query($connectEDB, $sql_find_training);
			break;
		case 7:
			$week["воскресение"] = mysqli_query($connectEDB, $sql_find_training);
			break;
		}
	}

	return td_and_modal($week);
}

function td_and_modal($week){
	$day = 'frst';
	$contacts = 'temproary var';
	
	$td_html = array();
	$mod_html = array();
	
	foreach ($week as $dayarr => $value) {
	$count = 0;	
		
		
		foreach ($value as $my) {
			$day = $dayarr;
			$table_open = '<table><tbody><th>'. $day.'</th>';
			$table_close = '</tbody></table>';
			$tr_open = '<tr>';
			$tr_close = '</tr>';
			$table_td = '<div>
    <td class="btn btn-link" data-toggle="modal" data-target="#'.'cell'. $my["id"] . '"' . ' style="display: block-inline; height: 100%;">'.
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
                <h5 class="modal-title" id="exampleModalLabel"> '. $day . $my["adress"] . $my["capacity"] . '</h5>
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
			//echo "<br>".$my["id"];
			//echo "<BR>".$day;
			//var_dump($my);
						
			if($count === 0){
				$td_html[]=$table_open;
				$td_html[]=$tr_open;
				$count++;
			}
				
			if ($count ===4 ){
				$td_html[]= $tr_close;
				$count = 1;
			} 
			$td_html[] = $table_td;
			$mod_html[] = $modal;
			$count++;
			

		}
	}
	$td_html = implode($td_html);
	$mod_html = implode($mod_html);
	$result = array();
	$result[] = ($td_html); 
	$result[]= ($mod_html);
		
	return $result;
} 
function add_to_string($my){

}

?>