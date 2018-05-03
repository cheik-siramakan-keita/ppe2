<?php
require('connexion.php');
require_once('classes/administrateur.php');
require('dao/interfaces/administrateurInterface.php');

class AdministrateurDAO implements AdministrateurInterface{
	public function connecter($administrateur_email, $administrateur_mot_de_passe){
		$connect = new Connect();
		$connexion = $connect->connexion();

		$requete = $connexion->prepare("SELECT administrateur_id, administrateur_mot_de_passe_hash FROM administrateur 
										WHERE administrateur_email = ?");
		$requete->execute(array($administrateur_email));
		$resultat = $requete->fetch();
		
		$administrateur_id = $resultat['administrateur_id'];
		$administrateur_mot_de_passe_hash = $resultat['administrateur_mot_de_passe_hash'];

		if($requete){
			if(password_verify($administrateur_mot_de_passe, $administrateur_mot_de_passe_hash)){
				$requete = $connexion->prepare("UPDATE administrateur SET administrateur_derniere_connexion = NOW() 
												WHERE administrateur_id = ?");
				$requete->execute(array($administrateur_id));

				if($requete){
					$requete = $connexion->prepare("SELECT administrateur_id, administrateur_super, administrateur_nom, 																								administrateur_prenom,administrateur_mot_de_passe_hash, administrateur_telephone,
												  		administrateur_email, administrateur_adresse, administrateur_ville,
												  		administrateur_code_postal, administrateur_derniere_connexion,
												  		administrateur_creation
													FROM administrateur WHERE administrateur_id = ?");
					$requete->execute(array($administrateur_id));

					if($requete){
						$resultat = $requete->fetch();

						$administrateur = new Administrateur($resultat['administrateur_id'], $resultat['administrateur_super'], $resultat['administrateur_nom'], $resultat['administrateur_prenom'], $resultat['administrateur_mot_de_passe_hash'], $resultat['administrateur_telephone'], $resultat['administrateur_email'], $resultat['administrateur_adresse'], $resultat['administrateur_ville'], $resultat['administrateur_code_postal'], $resultat['administrateur_derniere_connexion'], $resultat['administrateur_creation']);

						$requete = null;
						$connexion = null;
						return $administrateur;
					}else{
						echo 'erreur 1';
					}
				}else{
					echo 'erreur 2';
				}
			}else{
				echo 'erreur 3';
			}
		}else{
			echo 'erreur 4';
		}
	}

	public function inscrire($administrateur_super, $administrateur_nom, $administrateur_prenom, $administrateur_mot_de_passe_hash,
							 $administrateur_telephone, $administrateur_email, $administrateur_adresse,
							 $administrateur_ville, $administrateur_code_postal){
		$connect = new Connect();
		$connexion = $connect->connexion();

		$retour = false;

		$requete = $connexion->prepare("INSERT INTO administrateur(administrateur_super, $administrateur_nom, $administrateur_prenom, 
													administrateur_mot_de_passe_hash, administrateur_telephone, administrateur_email,
													administrateur_adresse, administrateur_ville,administrateur_code_postal,
													administrateur_derniere_connexion, administrateur_creation)
												VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())");
		$requete->execute(array($administrateur_super, $administrateur_nom, $administrateur_prenom, $administrateur_mot_de_passe_hash,
								$administrateur_telephone, $administrateur_email, $administrateur_adresse, $administrateur_ville, $administrateur_code_postal));

		if($requete->mysql_affected_rows()){
			$retour = true;
		}else{
			$retour = false;
		}

		return retour;
	}
}
?>