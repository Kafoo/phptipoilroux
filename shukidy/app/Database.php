<?php

namespace app;

use \PDO;

class Database{

	private $db_name;
	private $db_user;
	private $db_pass;
	private $db_host; 
	private $pdo;

	public function __construct($db_name, $db_user = 'root', $db_pass = ' ', $db_host = 'localhost'){

		$this->$db_name = $db_name;
		$this->$db_user = $db_user;
		$this->$db_pass = $db_pass;
		$this->$db_host = $db_host; 

	}

	private function getPDO(){
		if ($this->pdo === null) {
			$pdo = new PDO('mysql:host=127.0.0.1;dbname=heroku_3ca6f2b572bf369', "root", "");
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->pdo = $pdo;
		}
		return $pdo;
	}

	public function query($statement){
		$req = $this->getPDO()->query($statement);
		$datas = $req->fetchall(PDO::FETCH_OBJ);
		return $datas;
	}

}

?>