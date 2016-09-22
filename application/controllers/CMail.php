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
		//$this->email->to($abonne->getMail());
		$adresses=array($abonne->getMail(),'mtr-nico@hotmail.fr','ni.brossault1493@gmail.com','ni.brossault@yahoo.com');
		$this->email->bcc($adresses);
		
		$this->email->subject('Bienvenue '.$abonne->getPrenom().' '.$abonne->getNom().' !');
		
		$data=array(
				"prenom"=>utf8_encode($abonne->getPrenom()),
				"nom"=>utf8_encode($abonne->getNom()),
				"qstSec"=>utf8_encode($abonne->getIdQstSecrete()->getQuestion()),
				"reponse"=>utf8_encode($abonne->getReponse()),
				"titreMailBienvenue"=>utf8_encode($this->doctrine->em->getRepository('textsite')->findOneBy(array('idtextsite'=>5))->getTextSite()),
				"textMailBienvenue"=>utf8_encode($this->doctrine->em->getRepository('textsite')->findOneBy(array('idtextsite'=>6))->getTextSite()),
				);
		
		//--- le contenu du mail est dans une vue
		$contenuMail = $this->parser->parse('mail/mailBienvenue', $data, true);
		$this->email->message($contenuMail);
		
		$this->email->send();
		
		//redirect('CAccueil','auto');
	}
}