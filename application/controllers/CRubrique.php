<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CRubrique extends CI_Controller {
	
	public function __construct(){
		// Obligatoire
		parent::__construct();
		
		@$titre="Rubrique ".$_GET['nom'];
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
	}
	
	public function disconnect(){
		parent::__disconnect();
	}
	
	public function connexionAdmin(){
		parent::__connexionAdmin();
	}
	
	public function index(){
		//Récupération de la rubrique
		$nomRubrique=$_GET['nom'];
		
		//Test le nom de la rubrique passée en paramètre
		//si vide retour à l'accueil
		if($nomRubrique==""){
			redirect(base_url(),'auto');
		}
		
		//Test si la rubrique existe, rubrique passée en paramètre url
		$allRubriques=$this->doctrine->em->getRepository('rubrique')->findAll();
		foreach ($allRubriques as $oneRubrique){
			if($oneRubrique->getNomrubrique()==$nomRubrique){
				$rubrique=$this->doctrine->em->find('rubrique',$oneRubrique->getIdrubrique());
			}
		}
		
		//si vide retour à l'accueil
		if($rubrique==""){
			redirect(base_url(),'auto');
		}
		
		//Récupération de l'image associée à la rubrique
		$images=$this->doctrine->em->getRepository('images')->findAll();
		foreach($images as $image){
			if($image->getIdrubrique()!=NULL){
				if($image->getIdrubrique()->getIdrubrique()==$rubrique->getIdrubrique()){
					$imageRub=$image;
				}
			}
		}
		
		if(isset($imageRub)){
			$imgRub=$imageRub;
		}else{
			$imgRub=NULL;
		}
		
		//Récupération des articles et images associé
		$articlesImg=$this->getArticleRubrique($rubrique->getIdrubrique());
		
		$data=array(
				'articlesImg'=>$articlesImg,
				'rubrique'=>$rubrique,
				'image'=>$imgRub);
		
		if($this->isAdmin()){
			$data+=array('user'=>$this->doctrine->em->find('user',$_SESSION['user']));
		}
		
		$this->ajaxGet();
		$this->ajaxAddRub();
		
		//Passage des données à la view
		$this->layout->view("rubrique/vRubrique",$data);
	}
	
	/*
	 * Récupération des articles associés à la rubrique
	 * Récupération des images associées à l'article
	 * return les articles, les images
	 * params $idRubrique
	 */
	public function getArticleRubrique($idRubrique){
		$articles=array();
		$imagesArt=array();
		$allArticles=$this->doctrine->em->getRepository('articleRubrique')->findAll();
		foreach($allArticles as $article){
			if($article->getIdrubrique()->getIdrubrique()==$idRubrique){
				//Récupération des articles associé à la rubrique
				$articles[]=$article;
				//Récupération de l'image associée à l'article
				$imagesArt=$this->getImgArt($article);
			}
		}
		
		return array('articles'=>$articles,'imagesArt'=>$imagesArt);
	}
	
	public function getImgArt($article){
		return parent::__getImgArt($article);
	}
	
	public function isAdmin(){
		if(isset($_SESSION['user']) && !empty($_SESSION['user'])){
			return true;
		}
		return false;
	}
	
	public function addArticle($id=NULL){
		$idArticle=explode('_',$id);
		
		$articleRubrique=NULL;
		$imgArt=NULL;
		if($idArticle[1]!=NULL){
			$articleRubrique=$this->doctrine->em->find("articleRubrique",$idArticle[1]);
			$imgArt=$this->getImgArt($articleRubrique);
		}
		
		$rubrique=$this->doctrine->em->find('rubrique', $id);
		$this->load->view('rubrique/vAdd', array(
				'rubrique'=>$rubrique,
				'articleRubrique'=>$articleRubrique,
				'imgArt'=>$imgArt,
		));
	}
	
	public function valDeleteArticle($id){
		$article=$this->doctrine->em->find('articlerubrique', $id);
		$this->load->view('rubrique/vDelete', array('article'=>$article));
	}
	
	public function deleteArticle(){
		$article=$this->doctrine->em->find('articlerubrique', $_GET['id']);
		
		$imagesArticle=$this->doctrine->em->getRepository("images")->findAll();
		if(!empty($imagesArticle)){
			foreach($imagesArticle as $imgArt){
				if($imgArt->getIdArticleRubrique()!=NULL &&
				$imgArt->getIdArticleRubrique()->getIdarticlerubrique()==$article->getIdarticlerubrique()){
					echo $imgArt->getTitre();
					$imgSupp=$imgArt;
					$this->doctrine->em->remove($imgSupp);
				}
			}
		}
		
		$this->doctrine->em->remove($article);
		$this->doctrine->em->flush();
		redirect(base_url(),'auto');
		
		/*$msg='L\'article : "'.$article->getTitre().'" a bien été supprimé.';
		$this->layout->view('article/vDelete', array(
				'msg'		=>	$msg,
				'article'	=>	$article,
		));*/
	}
	
	
	public function addRubrique($id=NULL){
		parent::__addRubrique($id=NULL);
		
	}
	public function ajaxAddRub(){
		parent::__ajaxAddRubrique();
	}
	
	public function ajaxGet(){
		$jFunc='$(".cache").css({
				visibility : "visible",
				height : $(document).height()
		})';
		$this->javascript->getAndBindTo(
				'.btnEdit',
				'click',
				'CRubrique/addArticle',
				'.formAdd',
				$jFunc);
		$this->javascript->getAndBindTo(
				'.buttonAdd',
				'click',
				'CRubrique/addArticle',
				'.formAdd',
				$jFunc);
		$this->javascript->getAndBindTo(
				'.btnDelete',
				'click',
				'CRubrique/valDeleteArticle',
				'.formAdd',
				$jFunc);
		$this->javascript->getAndBindTo(
				'.btnValidDelete',
				'click',
				'CRubrique/deleteArticle',
				'.formAdd');
		$this->javascript->compile();
	}
}
