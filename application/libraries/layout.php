<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Layout {
	private $theme = 'themeMaterial';
	private $titre;
	private $itemsMenu = array();
	
	public function getTitre(){
		return $this->titre;
	}
	
	public function setTitre($titre){
		return $this->titre=$titre;
	}

	public function setItemsMenu($item){
		return $this->itemsMenu+=array($item);
	}
	
	public function view($name, $data = array()) {
		$CI =& get_instance();
		$data+=array('titre'=>$this->titre, 'itemsMenu'=>$this->itemsMenu);
		$params['content_for_layout'] = $CI->load->view($name, $data, true);
		$CI->load->view('themeMaterial/material', $params);
	}
}