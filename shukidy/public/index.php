<?php

use controllers\AvController;

require '../app/autoloader.php';
app\Autoloader::register();

$controller = new AvController();


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