<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CFormArticle extends CI_Controller {
	public function __construct(){
		// Obligatoire
		parent::__construct();
	}
	
	public function getImgArt($article){
		$imgsArt = parent::__getImgArt($article);
		
		if(!empty($imgsArt)){
			foreach ($imgsArt as $imgArt){
				return $imgArt;
			}
		}else{
			return NULL;
		}
	}
	
	public function getImgObj($objet, $entite){
		$imgsRub = parent::__getImgObj($objet, $entite);
		
		if(!empty($imgsRub)){
			//echo "test imgObj</br>";
			return $imgsRub;
		}else{
			//echo "test imgObj empty </br>";
			return NULL;
		}
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
			//echo "id Article : ".$id."<br>";
			$this->form_validation->set_rules('idArticle', 'Id de l\'article', 'trim');
			$object = $this->doctrine->em->find('articlerubrique', $id);
		}else{
			$object = new Articlerubrique();
		}
		if(isset($_POST['idRubrique']) && !empty($_POST['idRubrique'])){
			$id=$_POST['idRubrique'];
			//echo "id Rubrique: ".$id."<br>";
			$this->form_validation->set_rules('idRubrique', 'Id de l\'article', 'trim');
			$rubrique=$this->doctrine->em->find('rubrique',$id);
			$object->setIdrubrique($rubrique);
		}
		
		$this->form_validation->set_rules('titre', 'titre', 'required|trim|min_length[5]|xss_clean');
		if(isset($_POST['titre']) && !empty($_POST['titre'])){
			//echo "titre : ".$_POST['titre']."<br>";
			$object->setTitre(utf8_decode($_POST['titre']));
		}
		
		$this->form_validation->set_rules('texte', 'texte', 'required|trim|min_length[5]|xss_clean');
		if(isset($_POST['texte']) && !empty($_POST['texte'])){
			//echo "texte : ".$_POST['texte']."<br>";
			$object->setTextrubrique(utf8_decode($_POST['texte']));
		}
		
		if(isset($_FILES['fileImg']['name']) && !empty($_FILES['fileImg']['name'])){
			//echo "test images<br>";
			$dir    = 'assets/images/';
			$fileImages = scandir($dir);
			//Si image existe dans le dossier
			//ALORS on ne la télécharge pas -> exist = true
			$exist=false;
			foreach($fileImages as $fileImage){
				if($fileImage==$_FILES['fileImg']['name']){
					$exist=true;
				}
			}
			if(!$exist){
				$config['upload_path'] = 'assets/images/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg|JPG|PNG';
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
				$urlImg='images/'.$_FILES['fileImg']['name'];
				
				if(!empty($this->getImgArt($object))){
					//echo "l'article a une image </br>";
					$this->doctrine->em->remove($this->getImgArt($object));
				}
				
				$image=new Images();
				$image->setUrl($urlImg);
				$image->setTitre($_POST['titre']);
				$newImg=true;
			}
		}
		
		if(isset($_POST['existImg']) && !empty($_POST['existImg']) && !isset($newImg)){
			//echo "Recup Img: ".$_POST['existImg']."<br>";
			$images=$this->doctrine->em->getRepository('images')->findAll();
			$emptyImg=false;
						
			if($_POST['existImg']=="NULL"){
				$emptyImg=true;
				//echo "-> image : null </br>";
			}else{
				$this->form_validation->set_rules('existImg', 'Nom existImg', 'trim');
				$urlImg='images/'.$_POST['existImg'];
				
				$image=new Images();
				$image->setUrl($urlImg);
				$image->setTitre($_POST['titre']);
				$newImg=true;
			}
			
			if(!empty($this->getImgArt($object))){
				$existImg=$_POST['existImg'];
				if($_POST['existImg']=="NULL"){
					$existImg="images/".$_POST['existImg'];
				}
				//echo $existImg."==".$this->getImgArt($object)->getUrl()."<br>";
				if($existImg==$this->getImgArt($object)->getUrl()){
					//echo "Image de l'article : ".$_POST['existImg'].'</br>';
					$selectEmptyImg=true;
					$newImg=false;
				}else{
					//echo "-> Changement de l'image <br>";
					//permet de changer l'image de l'article
					//$this->doctrine->em->remove($this->getImgArt($object));
					
					$image = $this->getImgArt($object);
					
					//echo "-> URL image existante: ".$image->getUrl()."<br>";
					
					$this->form_validation->set_rules('existImg', 'Nom existImg', 'trim');
					$urlImg='images/'.$_POST['existImg'];
					
					//$image=new Images();
					$image->setUrl($urlImg);
					$image->setTitre($_POST['titre']);
					$newImg=true;
				}
			}
		}
		
		if ($this->form_validation->run() == FALSE){
			//echo 'test false <br>';
			$titre="Rubrique ".$rubrique->getNomrubrique();
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
			
			if(isset($_POST['idArticle']) && !empty($_POST['idArticle'])){
				$articlerubrique=$this->doctrine->em->find('articlerubrique',$_POST['idArticle']);
				//echo "articlerubrique true <br>";
			}else{
				$articlerubrique=new Articlerubrique();
				//echo "articlerubrique false <br>";
			}
			
			
			$this->layout->setFooter(
					$footerAccueil->getTextSite(),
					$imgFooter);
			
			
			$this->layout->view(
					'rubrique/vAdd',array(
					'rubrique'	=>	$rubrique,
					'articleRubrique' => $articlerubrique,
					));
		}else{
			//echo 'test true </br>';
			//Update or Put articleRubrique
			$this->doctrine->em->persist($object);
			$this->doctrine->em->flush();
			
			//Put Images
			if(isset($newImg) && $newImg){
				$articles=$this->doctrine->em->getRepository('articlerubrique')->findAll();
				foreach ($articles as $article){
					//echo "-> Id rubrique par l'article : ".$article->getIdrubrique()->getIdrubrique()."<br>";
					//echo "-> Id rubrique : ".$rubrique->getIdrubrique()."<br>";
					if($article->getIdrubrique()->getIdrubrique()==$rubrique->getIdrubrique()){
						if(empty($_POST['idArticle'])){
							$last=$article;
							//echo $last->getIdarticlerubrique()."<br>";
						}else{
							$last=$object;
							//echo $last->getIdarticlerubrique()."<br>";
						}
					}
				}
				
				$image->setIdarticlerubrique($last);
				$this->doctrine->em->persist($image);
				$this->doctrine->em->flush();
			}
			
			if(isset($emptyImg) && $emptyImg==true){
				//echo "test \'emptyImg\' <br>";
				$imgArt=$this->getImgObj($object, 'articlerubrique');
				if(!empty($imgArt) && 
					$imgArt->getIdarticlerubrique()->getIdarticlerubrique()==$object->getIdarticlerubrique()){
					//echo $imgArt->getIdarticlerubrique()->getIdarticlerubrique();
					$imgArt->setUrl("NULL");
					$imgArt->setTitre("NULL");
					$this->doctrine->em->persist($imgArt);
					$this->doctrine->em->flush();
				};
			}
			
			redirect('CRubrique?nom='.$rubrique->getNomrubrique(), 'refresh');
		}
	}
}
?>