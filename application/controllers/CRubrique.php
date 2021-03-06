<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CRubrique extends CI_Controller {
	
	public function __construct(){
		// Obligatoire
		parent::__construct();
		
		if(isset($_GET['nom']) && !empty($_GET['nom'])){
			$nomRub=explode('_',$_GET['nom']);
			@$titre="Rubrique ".utf8_decode(utf8_encode($nomRub[1]));
		}else{
			@$titre="undefined";
		}
		
		$this->layout->setTitre($titre);
		$items=array('Accueil');
		$nomRubrique=$this->doctrine->em->getRepository('rubrique')->findAll();
		foreach($nomRubrique as $item){
			$items[]=$item->getNomrubrique();
			if(isset($_GET['nom']) && !empty($_GET['nom']) && utf8_encode($item->getNomrubrique())==$_GET['nom']){
				$rubrique=$item;
			}
		}
		$this->layout->setItemsMenu($items);
		$footerAccueil=$this->doctrine->em->find('textsite',4);
		$imgFooter=array();
		
		if(isset($_GET['nom']) && !empty($_GET['nom'])){
			$marquesRubrique=$this->getMarqueRub($rubrique);
			foreach ($marquesRubrique as $marqueRubrique){
				//echo $marqueRubrique->getUrl()."<br>";
				$imgFooter[]=$marqueRubrique->getUrl();
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
		$nomRubrique=utf8_encode($_GET['nom']);
		
		//Test le nom de la rubrique passée en paramètre
		//si vide retour à l'accueil
		if($nomRubrique==""){
			redirect(base_url(),'auto');
		}
		
		//Test si la rubrique existe, rubrique passée en paramètre url
		$allRubriques=$this->doctrine->em->getRepository('rubrique')->findAll();
		foreach ($allRubriques as $oneRubrique){
			if(utf8_encode($oneRubrique->getNomrubrique())==utf8_decode($nomRubrique)){
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
				$imagesArt[]=$this->getImgObj($article,"articlerubrique");
			}
		}
		
		return array('articles'=>$articles,'imagesArt'=>$imagesArt);
	}
	
	public function getImgObj($objet, $entite){
		return parent::__getImgObj($objet, $entite);
	}
	
	public function getMarqueRub($objet){
		return parent::__getMarqueRub($objet);
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
			$articleRubrique=$this->doctrine->em->find("articlerubrique",$idArticle[1]);
			$imgArt=$this->getImgObj($articleRubrique,"articlerubrique");
		}
		
		$rubrique=$this->doctrine->em->find('rubrique', $id);
		$this->load->view('rubrique/vAdd', array(
				'rubrique'=>$rubrique,
				'articleRubrique'=>$articleRubrique,
				'imgArt'=>$imgArt,
		));
	}
	
	public function valDeleteArticle($id){
		$this->ajaxGet();
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
					////echo $imgArt->getTitre();
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
	
	public function valDeleteRub($id){
		$this->ajaxGet();
		$rubrique=$this->doctrine->em->find('rubrique', $id);
		$this->load->view('rubrique/vDelete', array('rubrique'=>$rubrique));
	}
	
	public function deleteRubrique(){
	//echo $_GET['id']."<br>";
		$rubrique=$this->doctrine->em->find('rubrique', $_GET['id']);
		$articles=$this->doctrine->em->getRepository('articlerubrique')->findAll();
		$articleRubrique=array();
		
		//echo $rubrique->getNomrubrique()."<br>";
		
		foreach ($articles as $article){
			if($article->getIdrubrique()->getIdrubrique()==$rubrique->getIdrubrique()){
				$articleRubrique[]=$article;
			}
		}
		
		if(isset($articleRubrique) &&!empty($articleRubrique)){
			foreach ($articleRubrique as $artRub){
				//echo $artRub->getTitre()."<br>";
				$imgArtRub=$this->getImgObj($artRub, "articlerubrique");
				if(isset($imgArtRub) && !empty($imgArtRub)){
					//echo "-> Image Associé : ".$imgArtRub->getTitre()."<br>";
					$this->doctrine->em->remove($artRub);
					$this->doctrine->em->remove($imgArtRub);
				}else{
					$this->doctrine->em->remove($artRub);
				}
				
			}
		}
		
		$marquesRub=$this->getMarqueRub($rubrique);
		foreach ($marquesRub as $marqueRub){
			$this->doctrine->em->remove($marqueRub);
		}
		
		$allMarqueRub=$this->doctrine->em->getRepository('marquesrubrique')->findAll();
		foreach ($allMarqueRub as $marquesRub){
			if($marquesRub->getIdrubrique()->getIdrubrique()==$rubrique->getIdrubrique()){
				$this->doctrine->em->remove($marquesRub);
			}
		}
		
		$imagesRub=$this->getImgObj($rubrique, "rubrique");
		if(isset($imagesRub) &&!empty($imagesRub)){
			if(count($imagesRub)==1){
				$this->doctrine->em->remove($imagesRub);
			}else{
				foreach ($imagesRub as $imageRub){
					$this->doctrine->em->remove($imageRub);
				}
			}
		}
		
		$this->doctrine->em->remove($rubrique);
		$this->doctrine->em->flush();
		redirect(base_url(),'auto');
	
		/*$msg='L\'article : "'.$article->getTitre().'" a bien été supprimé.';
			$this->layout->view('article/vDelete', array(
			'msg'		=>	$msg,
			'article'	=>	$article,
			));*/
	}
	
	
	public function addRubrique($id=NULL){
		return parent::__addRubrique($id);
		
	}
	public function ajaxAddRub(){
		parent::__ajaxAddRubrique();
	}
	
	public function ajaxGet(){
		$jFunc='$(".cache").css({
				visibility : "visible",
				height : $(document).height()
		})';
		$jSelect="$('select').material_select()";
		$jAnnule="$('.annuler').click(function(){
						$('.formAdd').empty();
						$('.cache').css('visibility','hidden');
					});";
		$jUtils="$('.func').click(function(){
				var func=$(this).attr('id');
				var text=$('.materialize-textarea').val()+'<'+func+'></'+func+'>';
					$('.materialize-textarea').val(text);
				});
				$('.clearText').click(function(){
					var text='';
					$('.materialize-textarea').val(text);
				});";
		$this->javascript->ready(
				"$('.btnEdit').click(function(){
					url='CRubrique/addArticle';
					url=url+'/'+$(this).attr('id');
					$.get(url,{}).done(function( data ) {
						$('.formAdd').html( data );
						$jSelect;
						$jAnnule;
						$jUtils;
					});
					$('.cache').css({
						visibility : 'visible',
						height : $(document).height()
					});
				});");
		$this->javascript->ready(
					"$('.buttonAdd').click(function(){
						url='CRubrique/addArticle';
						url=url+'/'+$(this).attr('id');
						$.get(url,{}).done(function( data ) {
							$('.formAdd').html( data );
							$jSelect;
							$jAnnule;
							$jUtils;
						});
						$('.cache').css({
							visibility : 'visible',
							height : $(document).height()
						});
					});");
		$this->javascript->ready(
				"$('.editRub').click(function(){
					url='CRubrique/addRubrique';
					url=url+'/'+$(this).attr('id');
					$.get(url,{}).done(function( data ) {
						$('.formAdd').html( data );
						$jSelect;
						$jAnnule;
						$jUtils;
					});
					$('.cache').css({
						visibility : 'visible',
						height : $(document).height()
					});
				});");
		
		$this->javascript->getAndBindTo(
				'.btnDelete',
				'click',
				'CRubrique/valDeleteArticle',
				'.formAdd',
				$jFunc);
		
		$this->javascript->getAndBindTo(
				'.btnDeleteRub',
				'click',
				'CRubrique/valDeleteRub',
				'.formAdd',
				$jFunc);
		$this->javascript->ready($jAnnule);
		
		$this->javascript->compile();
	}
}
