<?php
try{
	$bdd = new PDO('mysql:host=localhost;dbname=ppe;charset=utf8', 'root', '');
}catch(Exception $e){
	echo 'Échec lors de la connexion:' . $e->getMessage();
}
?>