<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CNewsletter extends CI_Controller {
	
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
		$data=array(
			'questions'=>$this->doctrine->em->getRepository('question')->findAll(),
		);
		
		if($this->isAdmin()){
			$data+=array('user'=>$this->doctrine->em->find('user',$_SESSION['user']));
		}
		
		$this->ajaxAddRub();
		$this->ajaxGet();
		$this->layout->view('newsletter/vNewsletter',$data);
	}
	
	public function disconnect(){
		parent::__disconnect();		
	}
	
	public function connexionAdmin(){
		parent::__connexionAdmin();
	}
	
	public function addRubrique($id=NULL){
		parent::__addRubrique($id=NULL);
	}
	public function ajaxAddRub(){
		parent::__ajaxAddRubrique();
	}
	public function ajaxGet($id=NULL){
		$jFunc='$(".carton").css({
					background : "white",
					color : "black"
				})';
		
		$this->javascript->ready("
					$('.btnEditText').click(function(){
						var idText = $(this).attr('id');
						url='CAccueil/editThisText/'+$(this).attr('id');
						$.get(url,{}).done(function( data ) {
							$('#text_'+idText).html( data );
						});
					});"
				);
		$this->javascript->getAndBindTo(
				'.btnEditPromo',
				'click',
				'CAccueil/editPromo',
				'.editPromo',
				$jFunc);
		$this->javascript->compile();
	}
}
