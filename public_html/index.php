
<html>
 <head>
  <title>Start with PHP PHP</title>
 </head>
 <body>
 <button>Кнопка с текстом</button>
 <a href="https://lvh.me">HIT ME</a>
 	<?php
 	include 'vk.php';

  echo '<p>Hello world!</p>'; 
  echo '<p>Великая депрессия2</p>'; 
  echo '<p> TEST </p>'; 
/* 
 $v = new Vk(array(
		'client_id' => 6738467, // (обязательно) номер приложения
		'secret_key' => 'TYxuhRTLXT2snl7iMfpP', // (обязательно) получить тут https://vk.com/editapp?id=6738467&section=options где 12345 - client_id
		'user_id' => 12345, // ваш номер пользователя в вк
		'scope' => 'wall', // права доступа
		'v' => '5.87' // не обязательно
	));

	$url = $v->get_code_token();

	echo $url;
 	
 	if(!isset($_GET['code'])) {
	$url = $v->get_code_token('code');
	header("Location: $url");

} else {
	$access_token = $v->get_access_token($_GET['code']);
}
*/
    $config['secret_key'] = 'TYxuhRTLXT2snl7iMfpP';
	$config['client_id'] = 6738467; // номер приложения
	$config['user_id'] = 12345; // id текущего пользователя (не обязательно)
	$config['access_token'] = '239cfd886501b91ffa981c29b8881b4c27334efd584fd48f8294b522d70177eb3131ba59e092b0482fb3f';
	$config['scope'] = 'wall'; // права доступа к методам (для генерации токена)

	$v = new Vk($config);
    $response = $v->friends->get(array(
	    'user_id' => 39891999,
	    'order' => 'hints',
	    'fields' => 'nickname,contacts',
	    'count' => 20
	));
	
	
	$str = json_encode($response,JSON_UNESCAPED_UNICODE);
	echo $str;
	echo $response["items"][0]["first_name"];
	
	
	
	
  ?>
 
 </body>
</html>
