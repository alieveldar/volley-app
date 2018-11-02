
<html>
 <head>
  <title>Start with PHP PHP</title>
 </head>
 <body>
 	<?php
 	include 'vk.php';

  echo '<p>Hello world!</p>'; 
  echo '<p>Великая депрессия2</p>'; 
  echo '<p> TEST </p>'; 
  $v = new Vk(array(
		'client_id' => 6738467, // (обязательно) номер приложения
		'secret_key' => 'TYxuhRTLXT2snl7iMfpP', // (обязательно) получить тут https://vk.com/editapp?id=12345&section=options где 12345 - client_id
		'user_id' => 514842413, // ваш номер пользователя в вк
		'scope' => 'wall', // права доступа
		'v' => '5.80' // не обязательно
	));

	$url = $v->get_code_token();

	echo $url;

if(!isset($_GET['code'])) {
	$url = $v->get_code_token('code');
	header("Location: $url");

} else {
	$access_token = $v->get_access_token($_GET['code']);
}
	$config['secret_key'] = 'ваш секретный ключ приложения';
	$config['client_id'] = 12345; // номер приложения
	$config['user_id'] = 12345; // id текущего пользователя (не обязательно)
	$config['access_token'] = '37baf6025f1c2cde2f';
	$config['scope'] = 'wall,photos,video'; // права доступа к методам (для генерации токена)

	$v = new Vk($config);

	// пример публикации сообщения на стене пользователя
	// значения массива соответствуют значениям в Api https://vk.com/dev/wall.post

	$response = $v->api('wall.post', array(
	    'message' => 'I testing API form https://github.com/fdcore/vk.api'
	));

	// или

	$response = $v->wall->post(array(
	    'message' => 'I testing API form https://github.com/fdcore/vk.api'
	));

  ?>
 
 </body>
</html>
