<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CRubrique extends CI_Controller {
	
	public function __construct(){
		// Obligatoire
		parent::__construct();
		$titre="Accueil";
		$this->layout->setTitre($titre);
		$items=array('Accueil');
		$nomRubrique=$this->doctrine->em->getRepository('rubrique')->findAll();
		foreach($nomRubrique as $item){
			$items[]=$item->getNomrubrique();
		}
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
		//Récupération de la rubrique
		$nomRubrique=$_GET['nom'];
		$allRubriques=$this->doctrine->em->getRepository('rubrique')->findAll();
		foreach ($allRubriques as $oneRubrique){
			if($oneRubrique->getNomrubrique()==$nomRubrique){
				$rubrique=$this->doctrine->em->find('rubrique',$oneRubrique->getIdrubrique());
			}
		}
		
		//Récupération de l'image associée à la rubrique
		$images=$this->doctrine->em->getRepository('images')->findAll();
		foreach($images as $image){
			if($image->getIdrubrique()!=NULL){
				if($image->getIdrubrique()->getIdrubrique()==$rubrique->getIdrubrique()){
					$image=$image->getUrl();
				}
			}
		}
		
		//Passage des données à la view
		$this->layout->view("rubrique/vRubrique", array(
				'rubrique'=>$rubrique,
				'image'=>$image,
		));
	}
}
