<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CFormArticle extends CI_Controller {
	public function __construct(){
		// Obligatoire
		parent::__construct();
	}

	function index(){
		$this->load->helper('text');
		$this->load->helper('security');
		
		//appel formulaire
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
		//Regle de validation
		//appel de l'object
		if(isset($_POST['idArticle']) && !empty($_POST['idArticle'])){
			$id=$_POST['idArticle'];
			//echo "id : ".$id."<br>";
			$this->form_validation->set_rules('idArticle', 'Id de l\'article', 'trim');
			$object = $this->doctrine->em->find('articlerubrique', $id);
		}else{
			$object = new Articlerubrique();
		}
		if(isset($_POST['idRubrique']) && !empty($_POST['idRubrique'])){
			$id=$_POST['idRubrique'];
			//echo "id : ".$id."<br>";
			$this->form_validation->set_rules('idRubrique', 'Id de l\'article', 'trim');
			$rubrique=$this->doctrine->em->find('rubrique',$id);
			$object->setIdrubrique($rubrique);
		}
		if(isset($_POST['titre']) && !empty($_POST['titre'])){
			//echo "titre : ".$_POST['titre']."<br>";
			$this->form_validation->set_rules('titre', 'Titre', 'trim|min_length[5]|xss_clean');
			$object->setTitre(utf8_decode($_POST['titre']));
		}
		if(isset($_POST['texte']) && !empty($_POST['texte'])){
			//echo "texte : ".$_POST['texte']."<br>";
			$this->form_validation->set_rules('texte', 'texte', 'trim|min_length[5]|xss_clean');
			$object->setTextrubrique(utf8_decode($_POST['texte']));
		}
		
		/*if(isset($_FILES['fileImg']['name']) && !empty($_FILES['fileImg']['name'])){
			$dir    = '../theDogsCrew-site/imagesPage/';
			$fileImages = scandir($dir);
			$exist=false;
			foreach($fileImages as $fileImage){
				if($fileImage==$_FILES['fileImg']['name']){
					$exist=true;
				}
			}
			if(!$exist){
				$config['upload_path'] = '../theDogsCrew-site/imagesPage/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$this->load->library('upload', $config);
		    	$this->upload->initialize($config);
		    	$this->upload->set_allowed_types('*');
				$data['upload_data'] = '';
		    
				if (!$this->upload->do_upload('fileImg')) {
					$data = array('msg' => $this->upload->display_errors());
				}else{
					$data = array('msg' => "Upload success!");
		      		$data['upload_data'] = $this->upload->data();
				}
				$urlImg='imagesPage/'.$_FILES['fileImg']['name'];
				$object->setImage($urlImg);
				//echo $object->getImage()."<br>";
			}
		}
		if(isset($_POST['existImg']) && !empty($_POST['existImg'])){
			//echo "Recup Img: ".$_POST['existImg']."<br>";
			if($_POST['existImg']=="NULL"){
				$object->setImage(NULL);
			}else{
				$this->form_validation->set_rules('existImg', 'Nom existImg', 'trim');
				$urlImg='imagesPage/'.$_POST['existImg'];
				$object->setImage($urlImg);
				//echo $object->getImage()."<br>";
			}
		}*/
		
		if ($this->form_validation->run() == FALSE){
			//echo 'test false';
			$titre="Rubrique ".$rubrique->getNomrubrique();
			//$titre="Rubrique";
			$this->layout->setTitre($titre);
			$items=array('Accueil');
			$nomRubrique=$this->doctrine->em->getRepository('rubrique')->findAll();
			foreach($nomRubrique as $item){
				$items[]=$item->getNomrubrique();
			}
			$this->layout->setItemsMenu($items);
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
			
			
			$this->layout->view('rubrique/vAdd',array(
								'rubrique'	=>	$rubrique,
								));
		}else{
			//echo 'test true';
			$this->doctrine->em->persist($object);
			$this->doctrine->em->flush();
			redirect('CRubrique?nom="'.$rubrique->getNomrubrique().'"', 'refresh');
		}
	}
}
?>