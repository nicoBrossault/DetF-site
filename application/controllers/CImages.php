<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CImages extends CI_Controller {
	
	public function __construct(){
		// Obligatoire
		parent::__construct();
		$titre="Gestion des Images";
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
		$data=array();
		
		$count=0;
		$allImages=array();
		if($this->isAdmin()){
			$data+=array('user'=>$this->doctrine->em->find('user',$_SESSION['user']));
		}else{
			redirect('CAccueil', 'refresh');
		}
		
		//Images
		$dir = 'assets/images';
		$fileImages = scandir($dir);
			
		foreach($fileImages as $fileImage){
			$count+=1;
		}
		for($i=2; $i<$count; $i++){
			$extension = substr($fileImages[$i], -3, 3);
			if($extension == "jpg" || $extension =="png"  || $extension =="JPG" || $extension =="PNG"){
				if($fileImages[$i]!="motif-cachemire.png"){
					$allImages[]=$fileImages[$i];
				}
			}
		}
		
		//Marques
		$allImagesMarK=array();
		$count=0;
		$dirMark = 'assets/images/marques';
		opendir($dirMark);
		$fileImagesMark = scandir($dirMark);
			
		foreach($fileImagesMark as $fileImageMark){
			$count+=1;
		}
		for($i=2; $i<$count; $i++){
			$extension = substr($fileImages[$i], -3, 3);
			if($extension == "jpg" || $extension =="png"  || $extension =="JPG" || $extension =="PNG"){
				$allImagesMarK[]=$fileImagesMark[$i];
			}
		}
		
		$data+=array('allImages'=>$allImages, 'allImagesMark'=>$allImagesMarK);
		
		$this->ajaxAddRub();
		$this->ajaxGet();
		$this->layout->view('images/vImages',$data);
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
