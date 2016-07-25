<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CPromo extends CI_Controller{
	public function _construct(){
		parent::__construct();
	}

	public function index(){
		$promo=$this->doctrine->em->find('promo',1);
		echo $promo->getTextpromo();
		$promo=$this->doctrine->em->find('marque',1);
		echo $promo->getUrl();
	}
}
?>