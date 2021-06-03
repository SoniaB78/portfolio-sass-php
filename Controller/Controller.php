<?php
namespace Controller;

	class Controller{
		private $db;

		public function __construct(){
			$this->db = new \model\EntityRepository; // récupère une connexion à la BDD (entity)

			if($_POST) {//sécurité pour les injection de code
				foreach ($_POST as $value) {
					$value = htmlspecialchars($value);
				}
			}
		}

		public function handlerRequest(){// récupère l'ordre donné par l'internaute
		
			$op = isset($_GET['op']) ? $_GET['op'] : NULL;// si op est définit (url), on le stock ($op) sinon stock null dans $op
			$page = isset($_GET['page']) ? $_GET['page'] : NULL;// si page est définit (url), on le stock ($page) sinon stock null dans $page
			
			try{
			    if($page == "admin") {
					if(isset($_SESSION['user'])) {
						$this->admin();
					} else {
						$this->homepage();
					}
				}
				// METHODE GET pour $op
				if($op == 'deconnexion') {
					session_destroy();
					 $this->redirect("index.php?page=homepage&table=profile");
				}
				// METHODE GET pour $page
				elseif($page == "homepage") {
					$this-homepage(); // on va executer la function qui permet de charger la page d'accueil.PHP dans layout de base grâce à la methode render
				} 
				elseif($page == "about-me") {
					$this-> aboutMe();
				}
				elseif($page == "contact") {
				    if(isset($_GET['statut'])) {
				        if($_GET['statut'] == "sent") {
				            $this->contact("Message envoyé !");
				        } else {
				            $this->contact("Echec d'envoie de message !");
				        }
				    }
				    else {
					    $this->contact();
				    }
				}
				elseif($page == "connexion") {
					$this->connexion();
				}
				
				elseif($page == ""){
				    $this->homepage(); // sinon affiche homepage  (ou alors on peut faire je pense si $page === null -> affiche homepage)
				} 

				// METHODE POST pour form
				if($_POST && isset($_POST['form'])) {
				    
					if($_POST['form'] == "add" ){// si on valide le formulaire avec la fonction add ça enregistre en BDD -> ADD
        				// 		$this->save($_GET["table"]);
        				// 		$this->saveImg($_FILES, $_GET["table"], $_GET["id"]);
						 $this->db->add($_GET["table"], $_FILES);
						echo "<script>window.location.href='?page=admin&table=$_GET[table]'</script>";
					}
					
					if($_POST['form'] == "modify"){// si on valide le form avec la fonction modify ça modifie l'élément concerné en BDD ->MODIFY
						$this->save($_GET["table"]);
						$this->saveImg($_FILES, $_GET["table"], $_GET["id"]);
					}
					
					if($_POST['form'] == "contact"){// si on valide le form ajoute en BDD -> CONTACT
						$notification = '';
						$errors = 0;

						$inputs = array("form", "nom", "prenom", "email", "objet", "message");
						foreach ($_POST as $key => $value) {

							$_POST[$key] = htmlspecialchars($_POST[$key]); //Sécurité 
						
							if(!in_array($key, $inputs)) {
								$errors += 1;
							}
						}
						if($errors < 1) {
							$headers = 'From: Portfolio <c1186199c@web45.lws-hosting.com>' . "\r\n";  
							$headers .= "X-Mailer: PHP ".phpversion()."\n";
							$headers .= "X-Priority: 2 \n";
							$headers .= "Mime-Version: 1.0\n";
							$headers .= "Content-type: text/html; charset= utf-8\n";
						
							if(mail("bougamha.sonia@gmail.com", $_POST['objet'], $_POST['message'], $headers)) {
								$this->saveNoRedirect($_GET["table"]);
								echo "<script>window.location.href='?page=contact&table=contact&statut=sent'</script>";
							} else {
								echo "<script>window.location.href='?page=contact&table=contact&statut=fail'</script>";
							}
						}
					}
					if(isset($_POST['form']) && $_POST["form"] == "connexion") {
						$this->connexion();
					}
				}
			}catch(Exception $e){
				throw new Exception($e->getMessage()); // envoie un message d'erreur et arrete le script si erreur dans try
			}	
		}

		public function saveImg($data, $table, $id) {
			$this->db->saveImg($data, $table, $id);
		}

		//Les fonctions RENDER
		public function render($layout, $template, $parameters = array()){ // $layout = où, $template=quoi, $parameters= ?
			extract($parameters);//permet d'avoir des indices du tableau comme variable
			ob_start(); // commence la temporisation de sortie
			require "view/$template";
			$content = ob_get_clean(); //$template, tout ce qu'il y a dans template sera stocké dans content
			//$blague = $this->apiJokes();

			ob_start(); // temporise la sortie d'affichage
			require "view/$layout";
			return ob_end_flush();// libère l'affichage   
		}
		
		public function homepage(){//render homepage dans le layout principal
			$this->render('layout.php', 'homepage.php');
		}
		public function connection(){
			$this->render('layout.php', 'connection.php');
		}
		public function aboutMe(){
			$this->render('layout.php', 'about-me.php');
		}

		//METHODE POST pour me connecter
		public function connexion(){
		    if($_POST) {
    			if(!empty($_POST['identifiant']) && !empty($_POST['mdp'])){//vérifie que ce n'est pas vide
    				$hashMdp = md5($_POST['mdp']);//hashage
    				if($this->db->connexion($_POST['identifiant'], $hashMdp)){//appel la fonction qui permet de vérifier la correspondance identifiant mdp.
    					$_SESSION["user"] = $_POST['identifiant'];//stock les info dans une session
    					$this->redirect("index.php?page=admin&table=profile");
    				} else {
    					echo '<div class="alert alert-warning">Mot de passe ou identifiant incorrect. Rééssayez ou fichez le camp!</div>';
    				}
    			} else {
    				echo '<div class="alert alert-warning">Attention identifiant ou mot de passe vide !</div>';
    			}
		    }
			$this->render('layout.php', 'connexion.php'
			);
		}
		
        // opération administrateur et redirections
		public function admin(){
			extract($_GET);

			if(isset($op) && $op == "delete") {
				$this->db->delete($id, $table);
				$this->redirect("?page=admin&table=$_GET[table]");
			}
			$this->render('layout_admin.php', 'backoffice.php', array( 
				'donnees' => $this->db->selectAll($_GET['table']), 
				'fields' => $this->db->getFields($_GET['table']),
				'options' => $this->getOptions($_GET['table'])
			));
		}

		function getOptions($table) {
			$tableauDOptions = array(
				"competencesCategorie" => array('front', 'back'),
				"parcoursCategorie" => array('diplome','experience'),
				"competencesNiveau" => array('débutante', 'confirmée', 'experte')
			);

			$tableau = array();

			switch ($table) {
				case 'competences':

					array_push($tableau, $tableauDOptions["competencesCategorie"]);
					array_push($tableau, $tableauDOptions["competencesNiveau"]);
					break;
				case 'parcourt':

					array_push($tableau, $tableauDOptions["parcoursCategorie"]);
					break;
			}

			return $tableau;
		}

		public function selectAll(){ // selectionne toutes les entrées d'une table
			$this->render('layout_admin.php', 'backoffice.php', array( 
				'donnees' => $this->db->selectAll($_GET['table']), 
				'fields' => $this->db->getFields($_GET['table']),
				'id' => 'id_' . $_GET['table']
			));
		}

		public function select(){// selectionne une entrée du tableau pour modifier ou supprimer ensuite
			$id = isset($_GET['id']) ? $_GET['id'] : NULL;

			$this->render('layout_admin.php', 'backoffice.php', array( 
				'donnees' => $this->db->select($id, $_GET['table']), 
				'fields' => $this->db->getFields($_GET['table']),
				'id' => 'id_' . $_GET['table']
			));
		}

		public function redirect($url){
			header("Location:" . $url);
		}//redirige

		
		public function save($table) {//enregistre une modification en BDD
			$this->db->save($table);
			echo "<script>window.location.href='?page=admin&table=$_GET[table]'</script>";// s'occupe de refresh la page
		}

	
		public function saveNoRedirect($table) {//enregistre une modification en BDD
			$this->db->save($table);
		}

		public function delete(){
			$id = isset($_GET['id']) ? $_GET['id'] : NULL;
			$r = $this->db->delete($id, $_GET['table']);
			$this->redirect("index.php");
		}

		// public function apiJokes() {
		// 	$blague = json_decode(file_get_contents("https://sv443.net/jokeapi/category/Programming"), true);//changer Programming contre Any pour avoir tous types de blagues
		// 	return $blague;
		// }
		


	}//------------ fin namespace Controller;
?>


