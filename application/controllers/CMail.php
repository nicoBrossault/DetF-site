<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CMail extends CI_Controller {
	public function index(){
		$this->bienvenue(1);
	}
	
	public function bienvenue($idAbonne=NULL){
		$this->email->initialize();
		
		$abonne=$this->doctrine->em->find('abonne',$idAbonne);
		
		//--- On charge les paramètres du fichier de configuration
		$this->email->initialize();
		$this->email->set_mailtype('html');
		$this->email->from('postmaster@localhost', 'Nico');
		//$this->email->to('ni.brossault1493@gmail.com');
		//$this->email->to('mtr-nico@hotmail.fr');
		$this->email->to($abonne->getMail());
		//$this->email->bcc('');
		
		$this->email->subject('Bienvenue '.$abonne->getPrenom().' '.$abonne->getNom().' !');
		
		$data=array(
				"prenom"=>$abonne->getPrenom(),
				"nom"=>$abonne->getNom(),
				"qstSec"=>$abonne->getIdQstSecrete()->getQuestion(),
				"reponse"=>$abonne->getReponse(),
				"titreMailBienvenue"=>$this->doctrine->em->getRepository('textsite')->findOneBy(array('idtextsite'=>5))->getTextSite(),
				"textMailBienvenue"=>$this->doctrine->em->getRepository('textsite')->findOneBy(array('idtextsite'=>6))->getTextSite(),
				);
		
		//--- le contenu du mail est dans une vue
		$contenuMail = $this->parser->parse('mail/mailBienvenue', $data, true);
		$this->email->message($contenuMail);
		
		$this->email->send();
		
		//redirect('CAccueil','auto');
	}
}