<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CMail extends CI_Controller {
	
	private $nom = 'Douceur & Fantaisie';
	private $adresse = 'postmaster@localhost';
	
	public function index(){
		$this->bienvenue(1);
	}
	
	public function bienvenue($idAbonne=NULL){
		$this->email->initialize();
		
		$abonne=$this->doctrine->em->find('abonne',$idAbonne);
		
		//--- On charge les paramètres du fichier de configuration
		$this->email->initialize();
		$this->email->set_mailtype('html');
		$this->email->from($this->adresse, $this->nom);
		//$this->email->to('ni.brossault1493@gmail.com');
		//$this->email->to('mtr-nico@hotmail.fr');
		$this->email->to($abonne->getMail());
		//$adresses=array($abonne->getMail(),'mtr-nico@hotmail.fr','ni.brossault1493@gmail.com','ni.brossault@yahoo.com');
		//$this->email->bcc($adresses);
		
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
		
		redirect('CAccueil','auto');
	}
	
	public function envoiePromo(){
		$promo=$this->doctrine->em->find('promo',1);
		$abonnes=$this->doctrine->em->getRepository('abonne')->findAll();
		$adresses=array();		
		
		//--- On charge les paramètres du fichier de configuration
		$this->email->initialize();
		$this->email->initialize();
		$this->email->set_mailtype('html');
		$this->email->from($this->adresse, $this->nom);
		
		foreach ($abonnes as $abonne){
			$adresses[]=$abonne->getMail();
		}
		
		$this->email->bcc($adresses);
		
		$this->email->subject(utf8_encode($promo->getLibellePromo()));
		
		$data=array(
				"titrePromo"=>utf8_encode($promo->getLibellepromo()),
				"textPromo"=>utf8_encode($promo->getTextPromo()),
		);
		
		//--- le contenu du mail est dans une vue
		$contenuMail = $this->parser->parse('mail/mailPromo', $data, true);
		$this->email->message($contenuMail);
		
		$this->email->send();
		
		redirect('CAccueil','auto');
	}
}