<?php


class perso
{
	//CONSTRUCTER
	public function __construct(){
	}

	//HYDRATER
	public function hydrate(array $infosPerso){

		foreach ($infosPerso as $key => $value){

			//On évite le doublage des keys numérotées
			if (!is_int($key)) {
				// On récupère le nom du setter correspondant à l'attribut.
				$method = 'set'.ucfirst($key);

				// Si le setter correspondant existe.
				if (method_exists($this, $method))
				{
				// On appelle le setter.
				$this->$method($value);
				}else{ //Sinon on assigne bêtement pour le moment
					$this->$key = $value;
				}
			}
		}
	}


	//SETTERS

/*	public function setId($id){

	}
	public function setUserID($userID){

	}
	public function setNom($nom){

	}
	public function setLvl($lvl){

	}
	public function setXp($xp){

	}
	public function setNature($nature){

	}
	public function setAttitude($attitude){

	}
	public function setConcept($concept){

	}
	public function setDefaut($defaut){

	}
	public function setPhysique($physique){

	}
	public function setClan($clan){

	}
	public function setC1($c1){

	}
	public function setC2($c2){

	}
	public function setC3($c3){

	}
	public function setC4($c4){

	}
	public function setC5($c5){

	}
	public function setC1Cond($c1Cond){

	}
	public function setC2Cond($c2Cond){

	}
	public function setC3Cond($c3Cond){

	}
	public function setC4Cond($c4Cond){

	}
	public function setC5Cond($c5Cond){

	}
	public function setLore($lore){

	}
	public function setDiscID($discID){

	}
	public function setActif($actif){

	}
	public function setPv($pv){

	}
	public function setInvent1($invent1){

	}
	public function setInvent2($invent2){

	}
	public function setInvent3($invent3){

	}
	public function setInvent4($invent4){

	}
	public function setInvent5($invent5){

	}*/




}

?>