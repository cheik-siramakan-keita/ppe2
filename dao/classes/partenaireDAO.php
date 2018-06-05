<?php
require_once('connexion.php');
require_once('classes/offre.php');
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

			if($requete->rowcount()){
				$requete = $connexion->prepare("SELECT partenaire_id, partenaire_siret, partenaire_nom, 														   				   partenaire_mot_de_passe_hash, partenaire_telephone, partenaire_email, 
													   partenaire_adresse, partenaire_ville, partenaire_code_postal,
													   partenaire_derniere_connexion, partenaire_creation 
											    FROM partenaire WHERE partenaire_id = ?");
				$requete->execute(array($partenaire_id));

				if($requete->rowcount()){
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

	public function obtenirOffre($partenaire_id){
		$connect = new Connect();
		$connexion = $connect->connexion();

		$requete = $connexion->prepare("SELECT offre.offre_id, offre.formation_id, formation.formation_nom, partenaire.partenaire_nom, offre.offre_nom, offre.offre_debut, 
											   offre.offre_description, offre.offre_fin, offre.offre_creation FROM offre 
											   JOIN formation ON offre.formation_id = formation.formation_id JOIN partenaire ON 
											   offre.partenaire_id = partenaire.partenaire_id WHERE partenaire.partenaire_id = ?");
		$requete->execute(array($partenaire_id));

		return $requete;
		$requete = null;
		$connexion = null;
	}

	public function modifierOffre($offre){
		$connect = new Connect();
		$connexion = $connect->connexion();

		$requete = $connexion->prepare("UPDATE offre SET formation_id = ?, offre_nom = ?, offre_description = ?, offre_debut = ?, offre_fin = ?
													 WHERE offre_id = ?");
		$requete->execute(array($offre->getFormation_id(),
								$offre->getOffre_titre(),
								$offre->getOffre_description(),
								$offre->getOffre_debut(),
								$offre->getOffre_fin(),
								$offre->getOffre_id()));

		$requete = null;
		$connexion = null;
	}

	public function suprimmerOffre($offre_id){
		$connect = new Connect();
		$connexion = $connect->connexion();

		$requete = $connexion->prepare("DELETE FROM offre WHERE offre_id = ?");
		$requete->execute(array($offre_id));

		$requete = null;
		$connexion = null;
	}
}
?>