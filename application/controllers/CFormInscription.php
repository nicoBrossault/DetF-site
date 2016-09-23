<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CFormInscription extends CI_Controller {
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
		$object = new Abonne();
		
		$this->form_validation->set_rules('nom', 'nom', 'required|trim|xss_clean');
		if(isset($_POST['nom']) && !empty($_POST['nom'])){
			//echo "nom : ".$_POST['nom']."<br>";
			$object->setNom(utf8_decode($_POST['nom']));
		}
		
		$this->form_validation->set_rules('prenom', 'prenom', 'required|trim|xss_clean');
		if(isset($_POST['prenom']) && !empty($_POST['prenom'])){
			//echo "prenom : ".$_POST['prenom']."<br>";
			$object->setPrenom(utf8_decode($_POST['prenom']));
		}
		
		$this->form_validation->set_rules('mail', 'mail', 'required|trim|xss_clean');
		if(isset($_POST['mail']) && !empty($_POST['mail']) && isset($_POST['mail2']) && !empty($_POST['mail2'])){
			//echo "mail : ".$_POST['mail']."<br>";
			$isMailValid=true;
			if($_POST['mail']==$_POST['mail2']){
				$object->setMail(utf8_decode($_POST['mail']));
			}else{
				$isMailValid=False;
				$errorMail="Les adresses mail entrées ne sont pas égales...";
			}
		}else{
			$isMailValid=False;
			$errorMail="L'adresse mail n'est pas renseignée...";
		}
		
		//Question
		if(isset($_POST['selectQst']) && !empty($_POST['selectQst'])){
			//echo "id question : ".$_POST['selectQst']."<br>";
			$object->setIdQstSecrete($this->doctrine->em->find("question",$_POST['selectQst']));
		}
		$this->form_validation->set_rules('mail', 'mail', 'required|trim|xss_clean');
			
		if(isset($_POST['reponse']) && !empty($_POST['reponse'])){
			//echo "reponse : ".$_POST['reponse']."<br>";
			$object->setReponse(utf8_decode($_POST['reponse']));
		}
		
		if ($this->form_validation->run() == FALSE || $isMailValid==False){
			//echo 'test false <br>';
			$titre="Inscription";
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
			
			
			$this->layout->view(
					'newsletter/vNewsletter',array(
							'questions'=>$this->doctrine->em->getRepository('question')->findAll(),
							'errorMail'=>$errorMail,
					));
		}else{
			//echo 'test true </br>';
			//Put Abonnees
			$this->doctrine->em->persist($object);
			$this->doctrine->em->flush();
			
			redirect('CMail/bienvenue/'.$object->getIdabonne(), 'refresh');
			//redirect('CAccueil', 'refresh');
		}
	}
}
?>