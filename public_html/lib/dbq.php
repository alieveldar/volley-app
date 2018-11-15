<?php
function get_alltraining($connectEDB) {
	$day = 1;
	$week = array();
	$day_name = '';
	$sql_find_training = "SELECT training.day_of_week, training_level.description, volley_room.adress, training.start_time, training.capacity, trainer.first_name, trainer.last_name, trainer.tel, volley_room.ya_map, training.date, training.price, training_level.intensity, training.id
FROM training, volley_room, training_level, trainer
WHERE training.day_of_week =" . $day . " AND training.level = training_level.id AND training.volley_room = volley_room.id AND training.trainer = trainer.id";
/*
mysqli_set_charset($connectEDB, "utf8");
$result = mysqli_query($connectEDB, $sql_find_training);
mysqli_data_seek($result, 2);
$result = mysqli_fetch_assoc($result);
 */
	for ($i = 1; $i <= 7; $i++) {
		$day = $i;

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

	return $week;
}
?>