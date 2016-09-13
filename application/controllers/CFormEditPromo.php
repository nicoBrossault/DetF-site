<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CFormEditPromo extends CI_Controller {
	public function __construct(){
		// Obligatoire
		parent::__construct();
	}
		
	function index(){
		$this->load->helper('text');
		$this->load->helper('security');
		
		//appel formulaire
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
		//Regle de validation
		//appel de l'object
		$object = $this->doctrine->em->find('promo', 1);
		
		if(isset($_POST['user']) && !empty($_POST['user'])){
			$object->setIduser($this->doctrine->em->find('user',$_POST['user']));
		}
		
		$this->form_validation->set_rules('titre', 'titre', 'required|trim|min_length[5]|xss_clean');
		if(isset($_POST['titre']) && !empty($_POST['titre'])){
			//echo "titre : ".$_POST['titre']."<br>";
			$object->setNompromo(utf8_decode($_POST['titre']));
		}
		
		$this->form_validation->set_rules('texte', 'texte', 'required|trim|min_length[5]|xss_clean');
		if(isset($_POST['texte']) && !empty($_POST['texte'])){
			//echo "texte : ".$_POST['texte']."<br>";
			$object->setTextpromo(utf8_decode($_POST['texte']));
		}
		
		if(isset($_POST['checkActif']) && !empty($_POST['checkActif'])){
			foreach($_POST['checkActif'] as $isActif){
				//echo "actif : true<br>";
				$actif=true;
			}
			$object->setActif($actif);
		}else{
			//echo "actif : false<br>";
			$actif=false;
			$object->setActif($actif);
		}
		
		if ($this->form_validation->run() == FALSE){
			//echo 'test false <br>';
			$titre="Promo";
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
			
			$promo=$this->doctrine->em->find('promo',1);
			
			
			$this->layout->setFooter(
					$footerAccueil->getTextSite(),
					$imgFooter);
			
			
			$this->layout->view(
					'accueil/vEditPromo',array(
					'promo'	=>	$promo,
					));
		}else{
			//echo 'test true </br>';
			//Update or Put articleRubrique
			$this->doctrine->em->persist($object);
			$this->doctrine->em->flush();
			redirect('CAccueil', 'refresh');
		}
	}
}
?>