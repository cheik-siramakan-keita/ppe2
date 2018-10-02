<?php
$request_uri = explode('?', $_SERVER['REQUEST_URI'], 2);

switch ($request_uri[0]) {
    case "/ppe2":
        include("app/controllers/IndexController.php");
		break;
   
    case "/ppe2/administrateur/connexion":
		include("app/controllers/AdministrateurConnexionController.php");
		break;

    case "/ppe2/administrateur/modifier-mes-informations":
		include("app/controllers/AdministrateurModifierMesInformationsController.php");
		break;
 
    case "/ppe2/administrateur/camemberts":
		include("app/controllers/AdministrateurCamembertsController.php");
		break;

    case "/ppe2/administrateur/gestion/administrateur":
		include("app/controllers/AdministrateurGestionAdministrateurController.php");
    	break;

    case "/ppe2/administrateur/gestion/administrateur/inscription":
		include("app/controllers/AdministrateurGestionAdministrateurInscriptionController.php");
		break;

    case "/ppe2/administrateur/gestion/administrateur/modification":
		include("app/controllers/AdministrateurMenuModifierAdministrateurController.php");
		break;

    case "/ppe/administrateur/gestion/administrateur/supression":
		include("app/controllers/AdministrateurMenuSuppressionAdministrateurController.php");
		break;

	case "/ppe2/administrateur/gestion/partenaire":
		include("app/controllers/AdministrateurMenuGestionPartenaireController.php");
		break;
	
    case "/ppe2/administrateur/gestion/partenaire":
		include("app/controllers/AdministrateurMenuPartenaireController.php");
		break;

    case "/ppe2/administrateur/gestion/partenaire/modification":
		include("app/controllers/AdministrateurMenuModifierPartenaireController.php");
		break;

	case "/ppe2/administrateur/gestion/jeune":
		include("app/controllers/AdministrateurGestionJeuneController.php");
		break;

    case "/ppe2/administrateur/gestion/jeune/modification":
		include("app/controllers/AdministrateurMenuModifierJeuneController.php");
		break;

    case "/ppe2/partenaire/connexion":
		include("app/controllers/PartenaireConnexionController.php");
        break;

    case "/ppe2/partenaire/inscription":
		include("app/controllers/PartenaireInscriptionController.php");
		break; 
 
    case "/ppe2/partenaire/supprimmer":
		include("app/controllers/PartenaireSupressionController.php");
		break;    
	
    case "/ppe2/jeune/connexion":
		include("app/controllers/JeuneConnexionController.php");
		break;

	case "/ppe2/jeune/inscription":
		include("app/controllers/JeuneInscriptionController.php");
		break;

    case "/ppe2/jeune/supprimmer":
		include("app/controllers/JeuneSuppressionController.php");

    case "/ppe2/test/class":
		include("test/Class.php");
		break;

    case "/ppe2/test/db/connexion":
		include("test/DBConnection.php");
		break;

    case "/ppe2/partenaire/menu/accueil":
		include("app/controllers/PartenaireMenuAccueilController.php");
    	break;

    case "/ppe2/jeune/connexion":
		include("app/controllers/JeuneConnexionController.php");
		break;

    case "/ppe2/jeune/menu/accueil": 
		include("app/controllers/JeuneMenuAccueilController.php");
		break;
  
    case "/ppe2/test/connexion":
		include("test/ConnexionTest.php");
		break;
	
    default:
        require("app/controllers/MissingController.php");
        break;
}
?>