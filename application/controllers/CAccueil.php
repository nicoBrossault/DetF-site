<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CAccueil extends CI_Controller {
	
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
		$accueil=$this->doctrine->em->find('textSite',1);
		$horaire=$this->doctrine->em->find('textSite',2);
		$newLetter=$this->doctrine->em->find('textSite',3);
		$data=array(
				'accueil'=>$accueil,
				'horaire'=>$horaire,
				'newLetter'=>$newLetter);
		
		if($this->isAdmin()){
			$data+=array('user'=>$this->doctrine->em->find('user',$_SESSION['user']));
		}
		
		$this->ajaxAddRub();
		$this->ajaxGet();
		$this->layout->view('accueil/vAccueil',$data);
	}
	
	public function editThisText($id=NULL){
		$this->javascript->ready("
					$('.annuler').click(function(){
						console.log('annuler');
						document.location.reload(true);
					});"
				);
		
		$this->javascript->compile();
		
		$this->load->view('accueil/vEdit', 
				array(
						'textSite'=>$this->doctrine->em->find('textsite',$id),
				));
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
		$jFunc='$(".cache").css({
				visibility : "visible",
				height : $(document).height()
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
		$this->javascript->compile();
	}
}
