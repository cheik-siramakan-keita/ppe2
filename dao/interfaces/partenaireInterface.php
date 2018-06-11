<?php
interface PartenaireInterface{
	public function connecter($partenaire_siret, $partenaire_mot_de_passe);
	public function inscrire($partenaire);
	public function lister();
	public function modifier($partenaire);
	public function suprimmer($partenaire_id);
}
?>