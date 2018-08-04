<?php
session_start();
require_once('framework/engine.php');
require_once('dao/class/jeuneDAO.php');

$engine = new Engine();
$jeuneDAO = new JeuneDAO();

$url = $engine->url();
$engine->jeune_session_check();
$engine->assign("titre", "Modifier Jeune");
$engine->assign("nom", $_SESSION['jeune_nom']);
$engine->assign("prenom", $_SESSION['jeune_prenom']);
$engine->assign("telephone", $_SESSION['jeune_telephone']);
$engine->assign("email", $_SESSION['jeune_email']);
$engine->assign("adresse", $_SESSION['jeune_adresse']);
$engine->assign("ville", $_SESSION['jeune_ville']);
$engine->assign("code postal", $_SESSION['jeune_code_postal']);

if(isset($_POST['form_auth'])){
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
						$jeune = new Jeune($_SESSION["jeune_id"], $nom, $prenom, null, $telephone, $email, $adresse, $ville, $code_postal, null, null);
						$jeuneDAO->modifier($jeune);
						$engine->deconnecter();
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

$engine->render("jeunemodifiermesinformations.html");
?>