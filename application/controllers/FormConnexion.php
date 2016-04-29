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
	}
	
	public function index(){
		//appel formulaire
		$isUser=false;
		$users = $this->doctrine->em->getRepository("user")->findAll();
		$msg="";
		
		if(isset($_POST['mailUser'])){
			$this->form_validation
			->set_rules('mailUser', 'Nom d\'utilisateur', 'required', 'trim|required|min_length[5]|xss_clean');
			foreach($users as $user){
				if($user->getMail()==$_POST['mailUser']){
					$isUser=true;
					$idUser=$user->getIduser();
				}else{
					$msg="Mail invalide : ".$_POST['mailUser']."<br>";
					$isUser=false;
				}
			}
		}
		if(isset($_POST['mdp']) && isset($isUser) && isset($idUser)){
			$this->form_validation
			->set_rules('mdp', 'Mot de passe', 'required', 'trim|required|xss_clean');
				
			$mdps=$this->doctrine->em->getRepository('mdpSalt')->findAll();
			foreach($mdps as $mdp){
				$selR=$mdp->getSaltr();
				$selL=$mdp->getSaltl();
			}
			$testUser=$this->doctrine->em->find('user',$idUser);
			$mdpComplet=$selR.sha1($_POST['mdp']).$selL;
			//$mdpComplet=sha1($_POST['mdp']);
			if($testUser->getMdp()==$mdpComplet){
				$isUser=true;
			}else{
				$msg.="Mot de passe invalide";
				$isUser=false;
			}
		}
		
		if ($this->form_validation->run() == FALSE || !$isUser){
			$this->layout->view('index/vConnexionAdmin', array('msg'=>$msg));
		}else{
			$_SESSION['user']=$idUser;
			redirect('CAccueil','auto');
		}
	}
}