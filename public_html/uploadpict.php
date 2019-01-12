<?php

    if ( 0 < $_FILES['file']['error'] ) {
        echo 'Error: ' . $_FILES['file']['error'] . '<br>';
    }
    else {
 		   	$contents= file_get_contents($_FILES['file']['tmp_name']);

     
        move_uploaded_file($_FILES['file']['tmp_name'], 'assets/img/rooms/' . $_FILES['file']['name']);
        if (!exif_imagetype('assets/img/rooms/' . $_FILES['file']['name'])){
        	echo "Файл не является изображением!!!";
        	unlink ('assets/img/rooms/' . $_FILES['file']['name'] );
        }else {
        	echo "Изображение загружено";
        }
    }
    
?>