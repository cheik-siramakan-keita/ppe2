<?php
require('connexion.php');
require_once('classes/partenaire.php');
require_once('dao/interfaces/partenaireInterface.php');

class PartenaireDAO implements PartenaireInterface{
	public function connecter($partenaire_siret, $partenaire_mot_de_passe){
		$connect = new Connect();
		$connexion = $connect->connexion();

		$requete = $connexion->prepare("SELECT partenaire_id, partenaire_mot_de_passe_hash FROM partenaire WHERE partenaire_siret = ?");
		$requete->execute(array($partenaire_siret));
		$resultat = $requete->fetch();
		$partenaire_id = $resultat['partenaire_id'];
		$partenaire_mot_de_passe_hash = $resultat['partenaire_mot_de_passe_hash'];

		if(password_verify($partenaire_mot_de_passe, $partenaire_mot_de_passe_hash)){
			$requete = $connexion->prepare("UPDATE partenaire SET partenaire_derniere_connexion = NOW() WHERE partenaire_id = ?");
			$requete->execute(array($partenaire_id));

			if($requete){
				$requete = $connexion->prepare("SELECT partenaire_id, partenaire_siret, partenaire_nom, 														   				   partenaire_mot_de_passe_hash, partenaire_telephone, partenaire_email, 
													   partenaire_adresse, partenaire_ville, partenaire_code_postal,
													   partenaire_derniere_connexion, partenaire_creation 
											    FROM partenaire WHERE partenaire_id = ?");
				$requete->execute(array($partenaire_id));
				$resultat = $requete->fetch();

				$partenaire = new Partenaire($resultat['partenaire_id'],
											 $resultat['partenaire_siret'],
											 $resultat['partenaire_nom'],
											 $resultat['partenaire_mot_de_passe_hash'],
											 $resultat['partenaire_telephone'],
											 $resultat['partenaire_email'],
											 $resultat['partenaire_adresse'],
											 $resultat['partenaire_ville'],
											 $resultat['partenaire_code_postal'],
											 $resultat['partenaire_derniere_connexion'],
											 $resultat['partenaire_creation']);
				$requete = null;
				$connexion = null;
				return $partenaire;
			}else{

			}
		}else{

		}
	}

	public function inscrire($partenaire){
		$connect = new Connect();
		$connexion = $connect->connexion();

		$requete = $connexion->prepare("INSERT INTO partenaire(partenaire_siret, partenaire_nom, partenaire_mot_de_passe_hash, partenaire_telephone, partenaire_email, partenaire_adresse, partenaire_ville, partenaire_code_postal, partenaire_derniere_connexion, partenaire_creation) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())");
		$requete->execute(array($partenaire->getPartenaire_siret(), 
								$partenaire->getPartenaire_nom(), 
								$partenaire->getPartenaire_mot_de_passe_hash(), 
								$partenaire->getPartenaire_telephone(), 
								$partenaire->getPartenaire_email(), 
								$partenaire->getPartenaire_adresse(), 
								$partenaire->getPartenaire_ville(), 
								$partenaire->getPartenaire_code_postal())); 

		$requete = null;
		$connexion = null;
	}
}
?>