<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Layout {
	private $theme = 'themeMaterial';
	private $titre;
	private $itemsMenu;
	private $footer=array();
	
	public function getTitre(){
		return $this->titre;
	}
	
	public function setTitre($titre){
		$titreAlpha=explode("_",$titre);
		return $this->titre=$titreAlpha;
	}

	public function setItemsMenu($item=array()){
		return $this->itemsMenu=$item;
	}
	
	public function setFooter($textFooter, $imgMarque=array()){
		return $this->footer=array('footer'=>$textFooter,
									'imgMarque'=>$imgMarque);
	}
	
	public function view($name, $data = array()) {
		$CI =& get_instance();
		$data+=array(	'titre'=>$this->titre,
						'itemsMenu'=>$this->itemsMenu,
						'footer'=>$this->footer,
		);
		$params['content_for_layout'] = $CI->load->view($name, $data, true);
		$CI->load->view('themeMaterial/material', $params);
	}
}