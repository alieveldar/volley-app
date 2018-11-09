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
			//echo $urlacc;
			//header($urlacc);

			
			$datasecret = file_get_contents($urlacc);
			$datasecret = json_decode($datasecret);
			echo $acctoken = $datasecret->{"access_token"};
			echo "<p>".$user_id = $datasecret->{"user_id"}."</p>";
			echo "<p>".$datasecret->{"expires_in"};
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
		add_user($datasecret,$connectEDB);
	}
	function add_user($datasecret, $connectEDB){
		echo "ADD_USEER_WILL";
		$role = 0;
		create_session($datasecret, $role);
	}

	function create_session ($datasecret, $role){
		echo "CREATE_SESSION_WILL";
	}

	if($connectEDB){
		echo "CON OK!!!";
		 echo mysqli_get_host_info($connectEDB);
		 check_user($datasecret, $connectEDB);
	}
	
	?>