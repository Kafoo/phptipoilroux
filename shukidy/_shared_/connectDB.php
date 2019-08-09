<?php

$onlinebdd = 0;

if (getenv('DB_PASSWORD') == false) {
	include('configDB.php');
} else{
	$db_host = getenv('DB_HOST');
	$db_name = getenv('DB_NAME');
	$db_user = getenv('DB_USER');
	$db_password = getenv('DB_PASSWORD');
}

if ($onlinebdd == 0) {
	$bdd = new PDO('mysql:host=127.0.0.1;dbname='.$db_name, "root", "");
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}else{
	$bdd = new PDO('mysql:host='.$db_host.';dbname='.$db_name, $db_user, $db_password);
};
