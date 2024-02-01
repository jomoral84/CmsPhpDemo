<?php

ob_start();

$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "cms";

// $db['db_host'] = "localhost";
// $db['db_user'] = "root";
// $db['db_pass'] = "";
// $db['db_name'] = "cms";


// foreach ($db as $key => $value) {
// 	define(strtoupper($key), $value);         // Convierte las variables en constantes poniendolas en mayusculas 
// }

// $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

$connection = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

$query = "SET NAMES utf8";
mysqli_query($connection, $query);


if (!$connection) {

	echo "Error en la conexion";
}
