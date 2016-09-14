<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CFormDesinscrire extends CI_Controller {
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
		
		//appel de l'object
		
		if(isset($_POST['abonne']) && !empty($_POST['abonne'])){
			$abonne=$this->doctrine->em->find('abonne', $_POST['abonne']);
		}
		
		if(isset($_POST['reponse']) && !empty($_POST['reponse'])){
			//echo "reponse : ".$_POST['reponse']."<br>";
			$reponse=$_POST['reponse'];
			$reponseAbonne=$abonne->getReponse();
			$lev = levenshtein($reponse, $reponseAbonne);
			$repAbonne=false;
			//echo $lev."<br>";
			if(isset($_POST['mail']) && !empty($_POST['mail'])){
				if($lev<=2 && $_POST['mail']==$abonne->getMail()){
					//echo "1";
					$repAbonne=true;
				}
			}
		}
		
		if(isset($repAbonne) && $repAbonne==true){
			$this->doctrine->em->remove($abonne);
			$this->doctrine->em->flush();
			
			redirect('CAccueil', 'refresh');
		}
	}
}
?>