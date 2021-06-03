<?php

namespace model;

class EntityRepository{
	private $db;
	
	public function getDb(){ // méthode pour la class PDO
		if(!$this->db){ // si db est vide on la créé
			try{
				$this->db = new \PDO('mysql:host=localhost;dbname=site_cv;charset=utf8', 'root', '', array(\PDO::ATTR_ERRMODE =>\PDO::ERRMODE_EXCEPTION));
			}catch(\PDOException $e){// on entre ici en cas de mauvaise connexion à la BDD
				die('Probleme de connexion à la BDD '. $e->getMessage());
			}
		}
		return $this->db;
	}

	public function selectAll($table){
		$q = $this->getDb()->query("SELECT * FROM " . $table); //sert à afficher toute la $table
		$r = $q->fetchAll(\PDO::FETCH_ASSOC);
		return $r;
	}//récupère toutes les infos

	public function getFields($table){ // récupère les données des champs de colonne de la table(nom des colonnes)
		$q = $this->getDb()->query("DESC " . $table);
		$r = $q->fetchAll(\PDO::FETCH_ASSOC);
		return array_slice($r, 1); // permet de ne pas récupérer le premier champs = idQuelquechose dans le form
	}

	public function select($id, $table){//récupère les données d'un par rapport à un id donné
		$q = $this->getDb()->query("SELECT * FROM " . $table . " WHERE id" . $table . "=" . (int) $id);
		$r = $q->fetch(\PDO::FETCH_ASSOC);
		return $r;
	}

	public function saveImg($data, $table, $id){ //-->UPDATE
		// link => destination de l'image qui va etre uploader dans le serveur
		$link = "view/inc/img/" . $data['image']['name'];

		// si l'image est bien enregistrée dans le server save aussi dans la bdd
		if(move_uploaded_file($data['image']['tmp_name'], $link)) {
			$this->getDb()->query("UPDATE $table set image='$link' where id_$table='$id'");
		}
	}

	public function save($table){ // créé une nouvelle entrée ou modifie celle dont l'ID existe  -->UPDATE
		$id = isset($_GET['id']) ? $_GET['id'] : 'NULL';
		unset($_POST["form"]);
		if($id == 'NULL') {
			$sql = 'REPLACE INTO ' . $table . '(' .implode(',',array_keys($_POST)) . ') VALUES (' . "'" . implode("','", $_POST) . "'" . ')';
		} else {
			$sql = 'REPLACE INTO ' . $table . '(id_' . $table . ',' .implode(',',array_keys($_POST)) . ') VALUES (' . $id . ',' . "'" . implode("','", $_POST) . "'" . ')';
		}

		$this->getDb()->query($sql);
	}// array_keys récupère tous les attributs name et le implode extrait les noms de colonnes de la table en les séparent par une virgule, REPLACE fait une recherche pour voir si l'ID existe

    public function add($table, $image) { //-->ADD
        // link => destination de l'image qui va etre uploader dans le serveur
		$link = "view/inc/img/" . $image['image']['name'];
        unset($_POST["form"]);
		// si l'image est bien enregistrée dans le server save aussi dans la bdd
		if(move_uploaded_file($image['image']['tmp_name'], $link)) {
		    if(!empty($image)) {
		        $sql = 'INSERT INTO ' . $table . ' (' . implode(',',array_keys($_POST)) . ', image) VALUES (' . "'" . implode("','", $_POST) . "'" . ", '$link')";
		    } else {
		        $sql = 'INSERT INTO ' . $table . ' (' . implode(',',array_keys($_POST)) . ') VALUES (' . implode("','", $_POST) . "'" . ')';
		    }

		    $this->getDb()->query($sql);
		}
    }

	public function delete($id, $table){
		$this->getDb()->query("DELETE FROM " . $table . " WHERE id_" . $table . '=' . (int) $id);
	}//blablabla = delete là ou l'ID correspond

	public function connexion($identifiant, $mdp) {// vérifie la présence d'un utilisateur avec le même mot de passe et identifiant
		$q = $this->getDb()->query("SELECT identifiant FROM profile WHERE identifiant='$identifiant' AND mdp='$mdp'");
		return $q->rowCount();
	}//Connect uniquement si l'identifiant et le mdp correspondent


}

?>