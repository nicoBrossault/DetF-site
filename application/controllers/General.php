<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class General extends CI_Controller {
	
	public function __construct(){
		// Obligatoire
		parent::__construct();
	}
	
	public function connexionAdmin(){
		$this->layout->view('accueil/vConnexionAdmin');
	}
	
	public function disconnect(){
		session_destroy();
		redirect("CAccueil","refresh");
	}
	
	public function isAdmin(){
		if(isset($_SESSION['user']) && !empty($_SESSION['user'])){
			return true;
		}
		return false;
	}
}
