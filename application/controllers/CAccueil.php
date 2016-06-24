<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CAccueil extends General {
	
	public function __construct(){
		// Obligatoire
		parent::__construct();
		$titre="Accueil";
		$this->layout->setTitre($titre);
		//items du menu
		$items=array('Accueil');
		$nomRubrique=$this->doctrine->em->getRepository('rubrique')->findAll();
		foreach($nomRubrique as $item){
			$items[]=$item->getNomrubrique();
		}
		$this->layout->setItemsMenu($items);
		//items du footer
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
		$data=array(
				'accueil'=>$accueil,
				'horaire'=>$horaire,
				'newLetter'=>$newLetter);
		
		if($this->isAdmin()){
			$data+=array('user'=>$this->doctrine->em->find('user',$_SESSION['user']));
		}
		
		$this->layout->view('accueil/vAccueil',$data);
	}
	
	public function connexionAdmin(){
		$this->layout->view('accueil/vConnexionAdmin');
	}
	
	public function disconnect(){
		session_destroy();
		redirect("CAccueil","refresh");
	}
	
	public function isAdmin(){
		if(isset($_SESSION['user']) && !empty($_SESSION['user'])){
			return true;
		}
		return false;
	}
}
