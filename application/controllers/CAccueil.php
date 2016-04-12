<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CAccueil extends CI_Controller {
	
	public function __construct(){
		// Obligatoire
		parent::__construct();
		$titre="Accueil";
		$this->layout->setTitre($titre);
		$this->layout->setItemsMenu('Accueil');
	}
	
	public function index(){
		$accueil=$this->doctrine->em->find('textSite',1);
		$horaire=$this->doctrine->em->find('textSite',2);
		$newLetter=$this->doctrine->em->find('textSite',3);
		$this->layout->view('accueil/vAccueil',array(
				'accueil'=>$accueil,
				'horaire'=>$horaire,
				'newLetter'=>$newLetter,
				
		));
	}
}
