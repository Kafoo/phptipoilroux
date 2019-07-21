<?php

$onlinebdd = 1;
$db_host = getenv('DB_HOST');
$db_name = getenv('DB_NAME');
$db_user = getenv('DB_USER');
$db_password = getenv('DB_PASSWORD');

if ($onlinebdd == 0) {
	$bdd = new PDO('mysql:host=127.0.0.1;dbname=heroku_3ca6f2b572bf369', "root", "");
}else{
	$bdd = new PDO('mysql:host='.$db_host.';dbname='.$db_name, $db_user, $db_password);
};
