<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CAccueil extends CI_Controller {
	
	public function __construct(){
		// Obligatoire
		parent::__construct();
		$titre="Accueil";
		$this->layout->setTitre($titre);
		$items=array('Accueil','Laine');
		$this->layout->setItemsMenu($items);
		$footerAccueil=$this->doctrine->em->find('textsite',4);
		$imgAccueilFooter=$this->doctrine->em->getRepository('images')->findAll();
		$imgFooter=array();
		foreach($imgAccueilFooter as $imgFooterData){
			if($imgFooterData->getIdTextSite()!=NULL){
				if($imgFooterData->getIdTextSite()->getIdTextSite()==4){
					$imgFooter[]=$imgFooterData->getUrl();
				}
			}
		}
		$this->layout->setFooter(
				$footerAccueil->getTextSite(),
				$imgFooter);
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
