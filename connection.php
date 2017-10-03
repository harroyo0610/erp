<?php
	$dsn = 'mysql:dbname=erprueda_com_datab;host=127.0.0.1';
	$user = 'root';
	$password = '';

try{

	$conn = new PDO($dsn, $user, $password);

}catch(PDOException $e){
	echo 'Error al conectarnos' . $e->getMessage();
}

?>