<?php

class Moteur{
	private $vars = array();

	public function assigner($parametres, $valeurs){
		$this->vars[$parametres] = $valeurs;
	}

	public function render($gabarit){
		$repertoire = "gabarit";

		if(file_exists($repertoire."/".$gabarit)){
			$contenu = file_get_contents("http://127.0.0.1/ppe2/gabarit/".$gabarit);

			foreach ($this->vars as $parametres => $valeurs){
				$contenu = str_replace('[[ '.$parametres.' ]]', '', $contenu);
				$contenu = str_replace('[parent['.$parametres.']]', $valeurs, $contenu);
			}
			echo $contenu;
		}else{
			exit('<h1>Erreur de Template</h1>');
		}
	}
}
?>