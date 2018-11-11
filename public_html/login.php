<?php
require_once('conf/config.php');
$v = array(
		'client_id' => 	6739525, // (обязательно) номер приложения
		'secret_key' => 'Z1G1vY4Hj2fxbG1qkTmA', // (обязательно) получить тут https://vk.com/editapp?id=6738467&section=options где 12345 - client_id
		'user_id' => 12345, // ваш номер пользователя в вк
		'scope' => 'wall', // права доступа
		'v' => '5.87'
		);
if (isset($_GET['code'])) {
	$datasecret = getAcces($_GET['code'],$v);
	}else {
 
	$url = "Location: https://oauth.vk.com/authorize?client_id=".$v["client_id"]."&display=popup&redirect_uri=https://lvh.me/&scope=".$v["scope"]."&response_type=code&v=5.87";
	
	header($url);
}
	function getAcces($code, $arr){
		$v = & $arr;
		$urlacc = "https://oauth.vk.com/access_token?client_id=".$v["client_id"]."&client_secret=".$v["secret_key"]."&redirect_uri=https://lvh.me/&code=".$code;			
			$datasecret = file_get_contents($urlacc);
			$datasecret = json_decode($datasecret);			
			return $datasecret;
	}

	function check_user($datasecret, $connectEDB){
		
		$user_id =  $datasecret->{"user_id"};
		$sql_find_ad = "SELECT role FROM ". TROOTS ." WHERE id_vk =". $user_id;
		$sql_find_user = "SELECT role FROM ". TUSERS ." WHERE id_vk =". $user_id;
		$result = mysqli_query($connectEDB, $sql_find_ad);
		if (mysqli_num_rows ($result) > 0) {
			$role = mysqli_result_fetch_assoc($result);
			$role = $role->{"role"};
		 	create_session($datasecret, $role);
		 } else {
		 	if (mysqli_num_rows(mysqli_query($connectEDB, $sql_find_user))>0) {
		 		destroy_user($datasecret, $connectEDB);
		 	}else{
		 		add_user($datasecret,$connectEDB);
		 	}
		 }
	}

	function destroy_user($datasecret, $connectEDB){
		echo "DESTROY_WILL";
		if(mysqli_query($connectEDB, "DELETE FROM ".TUSERS." WHERE id_vk=".$datasecret->{"user_id"})) {
		 echo "DELETED OK";
		 }else { 
		 	echo "SOME ERROR";
		}
		add_user($datasecret,$connectEDB);
	}
	function add_user($datasecret, $connectEDB){
		echo " ADD_USEER_WILL ";
		$role = 0;
		$data_db = get_data_vk($datasecret); 
		$user_data_db = $data_db["user_data_db"];
		$friends_data_db = $data_db["friends_data_db"];
		$sql_querry_add_user = "INSERT INTO ".TUSERS. " (id_vk, first_name, last_name, age,role, sex, avatar) VALUES (". $datasecret->{"user_id"}.",". "'". $user_data_db->{"response"}[0]->{"first_name"}."'". ","."'" . $user_data_db->{"response"}[0]->{"last_name"}."'" .","."'".$user_data_db->{"response"}[0]->{"bdate"}."'". ",". $role .",". $user_data_db->{"response"}[0]->{"sex"}. ",". "'".$user_data_db->{"response"}[0]->{"photo_50"}."'".")";
		
		if (mysqli_query($connectEDB, $sql_querry_add_user)){
			echo "<BR> INSERT OK!! ";
		}else {
			echo "ERROR SQL QUERRY  :". mysqli_error($connectEDB);
		}
		create_session($datasecret, $role);

	}

	function create_session ($datasecret, $role){
		echo "<br> CREATE_SESSION_WILL";
	}

	function get_data_vk($datasecret){
		$user_data_db = json_decode(file_get_contents("https://api.vk.com/method/users.get?user_ids=".$datasecret->{"user_id"}."&fields=first_name,last_name,contacts,nickname,photo_50,sex,bdate&access_token=".$datasecret->{"access_token"}."&v=5.87"));   
		/*   
		$friends_data_db = json_decode(file_get_contents("https://api.vk.com/method/friends.get?user_id=".$datasecret->{"user_id"}."&fields=first_name,last_name,contacts,nickname,photo_50,sex,bdate&order=hints&access_token=".$datasecret->{"access_token"}."&v=5.87"));
		*/
		$friends_data_db = 0; //delete when friends must be entered into the database
			$vk_data_db = array ("user_data_db" => $user_data_db, "friends_data_db" => $friends_data_db);

			return $vk_data_db;
	}
		/*
			function add_users_friends($connectEDB, $friends_data_db){

			}
*/
	if($connectEDB){
		echo "CON OK!!!";		 
		 check_user($datasecret, $connectEDB);
	}
	
	?>