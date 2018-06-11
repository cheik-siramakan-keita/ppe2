<?php
require_once('dao/classes/offreDAO.php');
session_start();

$url = "http://localhost:8000/ppe2/";

if(isset($_POST['deconnexion'])){
  if(session_destroy()){
    header("Location: ".$url);
  }
}

$offreDAO     = new OffreDAO();
$offre        = $offreDAO->lister();
?>
<!DOCTYPE html>
<html lang="FR">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Cheik-Siramakan Keita">
    <title>Accueil</title>
    
    <!-- CSS -->
    <link href="/ressources/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/ressources/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="/ressources/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <link href="/ressources/css/sb-admin.css" rel="stylesheet">
    <style type="text/css">
      body{
        background-color: white;
      }
    </style>
  </head>

  <body id="page-top">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
      <a class="navbar-brand" href="<?= $url ?>">PPE 2</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Administrateur
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <?php 
              if(!isset($_SESSION["administrateur_id"])){ 
              ?>
                <a class="dropdown-item" href="<?=  $url.'administrateur/connexion'  ?>">Connexion</a>
                <div class="dropdown-divider"></div>
              <?php
              }
              ?>
              <a class="dropdown-item" href="<?=  $url.'administrateur/profil'  ?>">Profil</a>
            </div>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Partenaire
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <?php 
              if(!isset($_SESSION["partenaire_id"])){ 
              ?>
              <a class="dropdown-item" href="<?=  $url.'partenaire/connexion'  ?>">Connexion</a>
              <a class="dropdown-item" href="<?=  $url.'partenaire/inscription'  ?>">Inscription</a>
              <div class="dropdown-divider"></div>
              <?php 
              } 
              ?>
              <a class="dropdown-item" href="<?=  $url.'partenaire/profil'  ?>">Profil</a>
            </div>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Jeune
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <?php 
              if(!isset($_SESSION["jeune_id"])){ 
            ?>
              <a class="dropdown-item" href="<?=  $url.'jeune/connexion'  ?>">Connexion</a>
              <a class="dropdown-item" href="<?=  $url.'jeune/inscription'  ?>">Inscription</a>
              <div class="dropdown-divider"></div>
            <?php 
            }
            ?>
              <a class="dropdown-item" href="<?php  $url.'jeune/profil'  ?>">Profil</a>
            </div>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
              <i class="fa fa-fw fa-sign-out"></i>Déconnexion</a>
          </li>
        </ul>
      </div>
    </nav>
    <div id="map" style="width:100%;height:400px;"></div><br>
    <div>
      <div class="container-fluid">
        <div class="card mb-3">
          <div class="card-header">
            <i class="fa fa-table"></i> Tableau des Offres</div>
          <div class="card-body">
            <div class="table-responsive">
              <form method="POST">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th scope="col">Type de formation</th>
                      <th scope="col">Nom</th>
                      <th scope="col">Partenaire</th>
                      <th scope="col">Début</th>
                      <th scope="col">Fin</th>
                      <th scope="col">Création</th>
                      <th scope="col">Description</th>
                      <?php
                      if(isset($_SESSION["jeune_id"])){
                        echo '<th scope="col">Accepter</th>';
                      }
                      ?>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th scope="col">Type de formation</th>
                      <th scope="col">Nom</th>
                      <th scope="col">Partenaire</th>
                      <th scope="col">Début</th>
                      <th scope="col">Fin</th>
                      <th scope="col">Création</th>
                      <th scope="col">Description</th>
                      <?php
                      if(isset($_SESSION["jeune_id"])){
                        echo '<th scope="col">Accepter</th>';
                      }
                      ?>
                    </tr>
                  </tfoot>
                  <tbody>
                  <?php 
                    while($resultat = $offre->fetch()){
                      echo '<tr>';
                        echo '<td>'.$resultat["formation_nom"].'</td>';
                        echo '<td>'.$resultat["offre_nom"].'</td>';
                        echo '<td>'.$resultat["partenaire_nom"].'</td>';
                        echo '<td>'.$resultat["offre_debut"].'</td>';
                        echo '<td>'.$resultat["offre_fin"].'</td>';
                        echo '<td>'.$resultat["offre_creation"].'</td>';
                        echo '<form method="POST">'; 
                          echo '<input type="hidden" name="offre_id" value="'.$resultat["offre_id"].'">';
                          echo '<input type="hidden" name="formation_id" value="'.$resultat["formation_id"].'">';
                          echo '<input type="hidden" name="offre_nom" value="'.$resultat["offre_nom"].'">';
                          echo '<input type="hidden" name="partenaire_nom" value="'.$resultat["partenaire_nom"].'">';
                          echo '<input type="hidden" name="offre_description" value="'.$resultat["offre_description"].'">';
                          echo '<input type="hidden" name="offre_debut" value="'.$resultat["offre_debut"].'">';
                          echo '<input type="hidden" name="offre_fin" value="'.$resultat["offre_fin"].'">';
                          echo '<input type="hidden" name="offre_creation" value="'.$resultat["offre_creation"].'">';
                          echo '<td><input class="btn btn-secondary my-2 my-sm-0" type="submit" name="modifier" value="Description"></td>';
                          if(isset($_SESSION["jeune_id"])){
                          echo '<td><input class="btn btn-secondary my-2 my-sm-0" type="submit" name="suprimmer" value="Accepter"></td>';
                          }
                        echo '</form>';
                      echo '</tr>';
                    } 
                  ?>
                  </tbody>
                </table>
              </form>
            </div>
          </div>
        </div>
      </div>

      <a class="scroll-to-top rounded" href="#page-top">
        <i class="fa fa-angle-up"></i>
      </a>
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Prêt à quitter?</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">Cliquez sur "Déconnexion" si vous êtes prêt a terminer vôtre session.</div>
            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
              <form method="POST">
                <input type="submit" class="btn btn-primary" name="deconnexion" value="Déconnexion">
              </form>
            </div>
          </div>
        </div>
      </div>

      <!-- JavaScript -->
      <script src="/ressources/js/core.js" ></script>
      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCSWaHpZ1NPnlUJC6OE45NqHJVwGOHwhmc&callback=map"></script>
      <script src="/ressources/vendor/jquery/jquery.min.js" ></script>
      <script src="/ressources/vendor/bootstrap/js/bootstrap.bundle.min.js" ></script>
      <script src="/ressources/vendor/jquery-easing/jquery.easing.min.js" ></script>
      <script src="/ressources/vendor/datatables/jquery.dataTables.js" ></script>
      <script src="/ressources/vendor/datatables/dataTables.bootstrap4.js" ></script>
      <script src="/ressources/js/sb-admin.min.js" ></script>
      <script src="/ressources/js/sb-admin-datatables.min.js" ></script>
    </div>
  </body>
</html>
