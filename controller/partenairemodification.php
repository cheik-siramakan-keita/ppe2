<?php
require_once('classes/partenaire.php');
require_once('dao/classes/partenaireDAO.php');
session_start();

$url = "http://localhost:8000/ppe2/";


$partenaire_id 			= $_SESSION['modifier_partenaire_id'];
$partenaire_siret 		= $_SESSION['modifier_partenaire_siret'];
$partenaire_nom 		= $_SESSION['modifier_partenaire_nom'];
$partenaire_telephone 	= $_SESSION['modifier_partenaire_telephone'];
$partenaire_email 		= $_SESSION['modifier_partenaire_email'];
$partenaire_adresse 	= $_SESSION['modifier_partenaire_adresse'];
$partenaire_ville 		= $_SESSION['modifier_partenaire_ville'];
$partenaire_code_postal = $_SESSION['modifier_partenaire_code_postal'];

if(isset($_POST['modifier'])){
	$partenaire_siret 		= $_POST['partenaire_siret'];
	$partenaire_nom 		= $_POST['partenaire_nom'];
	$partenaire_telephone 	= $_POST['partenaire_telephone'];
	$partenaire_email 		= $_POST['partenaire_email'];
	$partenaire_adresse 	= $_POST['partenaire_adresse'];
	$partenaire_ville 		= $_POST['partenaire_ville'];
	$partenaire_code_postal = $_POST['partenaire_code_postal'];

	if(!empty($partenaire_siret) && !empty($partenaire_nom) && !empty($partenaire_telephone) && !empty($partenaire_email) && !empty($partenaire_adresse)
		&& !empty($partenaire_ville) && !empty($partenaire_code_postal)){
		if(strlen($partenaire_siret) == 9){
			if(filter_var($partenaire_email, FILTER_VALIDATE_EMAIL)){
				if(strlen($partenaire_adresse) <= 38){
					if(strlen($partenaire_ville) <= 32){
						if(strlen($partenaire_code_postal) == 5){
							$partenaire = new partenaire($partenaire_id,
													 	 $partenaire_siret,
													 	 $partenaire_nom,
													 	 null,
													  	 $partenaire_telephone, 
													 	 $partenaire_email, 
													 	 $partenaire_adresse, 
													 	 $partenaire_ville, 
													 	 $partenaire_code_postal,
													 	 null,
													 	 null);
							$partenaireDAO = new PartenaireDAO();
							$partenaireDAO->modifier($partenaire);

							unset($_SESSION['modifier_partenaire_id'], 
								  $_SESSION['modifier_partenaire_siret'],
	 						  	  $_SESSION['modifier_partenaire_nom'], 
	  						  	  $_SESSION['modifier_partenaire_telephone'],
	  						  	  $_SESSION['modifier_partenaire_email'],
	  						  	  $_SESSION['modifier_partenaire_adresse'],
	  						  	  $_SESSION['modifier_partenaire_ville'],
	  						  	  $_SESSION['modifier_partenaire_code_postal']);

							if(isset($_SESSION["administrateur_id"])){
								header("Location: ".$url."administrateur/tableau/partenaire");
							}else{
								header("Location: ".$url."partenaire/profil");
							}
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
			echo 'La SIRET doit contenir 9 chiffres.';
		}
	}else{
		echo 'Les champs n\'ont pas tous ete remplis.';
	}
}

?>
<!DOCTYPE html>
<html>
  <head>
    <title>Partenaire Modification</title>
    <link href="/ressources/css/bootstrap.min.css" rel="stylesheet">
    <link href="/ressources/css/signin.css" rel="stylesheet">
  </head>

  <body class="text-center">
    <form method="POST" class="form-signin">
      <a href="<?= $url ?>"><h1 class="h3 mb-3 font-weight-normal">Partenaire Modification</h1></a>
      <label for="partenaire_siret" class="sr-only">SIRET</label>
      <input type="text" id="partenaire_siret" name="partenaire_siret" class="form-control" placeholder="SIRET" value="<?= $partenaire_siret ?>" autofocused><br/>
      <label for="partenaire_nom" class="sr-only">Nom</label>
      <input type="text" id="partenaire_nom" name="partenaire_nom" class="form-control" placeholder="Nom" value="<?= $partenaire_nom ?>" autofocused><br/>
      <label for="partenaire_telephone" class="sr-only">Téléphone</label>
      <input type="text" id="partenaire_telephone" name="partenaire_telephone" class="form-control" placeholder="Téléphone" value="<?= $partenaire_telephone ?>"><br/>
      <label for="partenaire_email" class="sr-only">Email</label>
      <input type="email" id="partenaire_email" name="partenaire_email" class="form-control" placeholder="Email" value="<?= $partenaire_email ?>"><br/>
      <label type="partenaire_adresse" class="sr-only">Adresse</label>
      <input type="text" id="partenaire_adresse" name="partenaire_adresse" class="form-control" placeholder="Adresse" value="<?= $partenaire_adresse ?>"><br/>
      <label for="partenaire_ville" class="sr-only">Ville</label>
      <input type="text" id="partenaire_ville" name="partenaire_ville" class="form-control" placeholder="Ville" value="<?= $partenaire_ville ?>"><br/>
      <label for="partenaire_code_postal" class="sr-only">Code postal</label>
      <input type="text" id="partenaire_code_postal" name="partenaire_code_postal" class="form-control" placeholder="Code Postal" value="<?= $partenaire_code_postal ?>"><br/>
      <input type="submit" name="modifier" class="btn btn-lg btn-primary btn-block" value="Modifier">
    </form>
  </body>
</html>