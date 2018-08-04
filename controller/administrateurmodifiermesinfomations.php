<?php
session_start();
require_once('framework/engine.php');
require_once('dao/class/administrateurDAO.php');

$engine = new Engine();

$url = $engine->url();
$engine->assign("titre", "Administrateur Modifier ses Informations");
$engine->assign("id", $_SESSION['administrateur_id']);
$engine->assign("nom", $_SESSION['administrateur_nom']);
$engine->assign("prenom", $_SESSION['administrateur_prenom']);
$engine->assign("super", $_SESSION['administrateur_super']);
$engine->assign("telephone", $_SESSION['administrateur_telephone']);
$engine->assign("email", $_SESSION['administrateur_email']);
$engine->assign("adresse", $_SESSION['administrateur_adresse']);
$engine->assign("ville", $_SESSION['administrateur_ville']);
$engine->assign("code postal", $_SESSION['administrateur_code_postal']);

if(isset($_POST['modifier'])){
	if(isset($_POST['super'])){
		$super= 1;
	}else{
		$super= 0;
	}

	$nom = $_POST['nom'];
	$prenom = $_POST['prenom'];
	$telephone = $_POST['telephone'];
	$email = $_POST['email'];
	$adresse = $_POST['adresse'];
	$ville = $_POST['ville'];
	$code_postal = $_POST['code_postal'];

	if(!empty($nom) && !empty($prenom) && !empty($telephone) && !empty($email) && !empty($adresse) && !empty($code_postal)){
		if(filter_var($email, FILTER_VALIDATE_EMAIL)){
			if(strlen($adresse) <= 38){
				if(strlen($ville) <= 32){
					if(strlen($code_postal) == 5){
						$administrateur = new Administrateur($_SESSION['administrateur_id'], $super, $nom, $prenom, null, $telephone, $email, $adresse, $ville, $code_postal, null, null);
						$administrateurDAO = new AdministrateurDAO();
						$administrateurDAO->modifier($administrateur);

						$engine->deconnecter();
						//header("Location: ".$url."/administrateur/profil");
					}else{
						echo 'La longeur du code postal est incorrecte il devrait faire 5 caracteres.';
					}
				}else{
					echo 'La longeur de la ville est incorrecte il devrait faire 32 caracteres ou moins.';
				}
			}else{
				echo 'La longeur de l\'adresse est incorrecte il devrait faire 38 caracteres ou moins.';
			}
		}else{
			echo 'Le format de l\'email est incorrecte.';
		}
	}else{
		echo 'Les champs n\'ont pas tous ete remplis.';
	}
}

$engine->render("administrateurmodifiermesinformations.html");
?>