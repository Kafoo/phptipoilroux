<?php

use controllers\AvController;
use app\Database;

require '../app/autoloader.php';
app\Autoloader::register();


//CLASS INIT
$db = new Database('heroku_3ca6f2b572bf369');



if (isset($_GET['p']) AND $_GET['p'] !=='') {
	$p = $_GET['p'];
}else{
	$p = 'home';
}

ob_start();


if ($p === 'home') {
	require '../pages/home.php';
}

$content = ob_get_clean();

require '../pages/templates/default.php';


?>