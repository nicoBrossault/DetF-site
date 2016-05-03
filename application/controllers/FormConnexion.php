<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FormConnexion extends CI_Controller {
	
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
		//appel formulaire
		$isUser=false;
		$users = $this->doctrine->em->getRepository("user")->findAll();
		$msg="";
		
		if(isset($_POST['mailUser'])){
			//echo $_POST['mailUser']."<br>";
			$this->form_validation
			->set_rules('mailUser', 'Nom d\'utilisateur', 'required', 'trim|required|min_length[5]|xss_clean');
			foreach($users as $user){
				if($user->getMail()==$_POST['mailUser']){
					$isUser=true;
					$idUser=$user->getIduser();
					//echo "true<br>";
				}else{
					$msg="Mail invalide : ".$_POST['mailUser']."<br>";
					$isUser=false;
					//echo "false<br>";
				}
			}
		}
		if(isset($_POST['mdp']) && isset($isUser) && isset($idUser)){
			//echo $_POST['mdp']."<br>";
			$this->form_validation
			->set_rules('mdp', 'Mot de passe', 'required', 'trim|required|xss_clean');

			$testUser=$this->doctrine->em->find('user',$idUser);
			$mdpComplet=sha1($_POST['mdp']);
			if($testUser->getMdp()==$mdpComplet){
				$isUser=true;
				//echo "true<br>";
			}else{
				$msg.="Mot de passe invalide";
				$isUser=false;
				//echo "false<br>";
			}
		}
		
		//var_dump($this->doctrine->em->find('user',$idUser));
		
		if ($this->form_validation->run() == FALSE || !$isUser){
			$this->layout->view('accueil/vConnexionAdmin', array('msg'=>$msg));
		}else{
			$_SESSION['user']=$user->getIduser();
			redirect(base_url(),'refresh');
		}
	}
}