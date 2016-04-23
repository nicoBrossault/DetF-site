<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CRubrique extends CI_Controller {
	
	public function __construct(){
		// Obligatoire
		parent::__construct();
		$titre="Accueil";
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
	
	public function index(){
		//Récupération de la rubrique
		$nomRubrique=$_GET['nom'];
		
		//Test le nom de la rubrique passée en paramètre
		//si vide retour à l'accueil
		if($nomRubrique==""){
			redirect(base_url(),'auto');
		}
		
		//Test si la rubrique exist rubrique passée en paramètre
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
					$image=$image;
				}
			}
		}
		
		//Récupération des articles et images associé
		$articlesImg=$this->getArticleRubrique($rubrique->getIdrubrique());
		
		//Passage des données à la view
		$this->layout->view("rubrique/vRubrique", array(
				'articlesImg'=>$articlesImg,
				'rubrique'=>$rubrique,
				'image'=>$image,
		));
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
				//Récupération des articles assovié à la rubrique
				$articles[]=$article;
				//Récupération de l'image associée à l'article
				$images=$this->doctrine->em->getRepository('images')->findAll();
				foreach($images as $image){
					if($image->getIdarticlerubrique()!=NULL){
						if($image->getIdarticlerubrique()->getIdarticlerubrique()==$article->getIdarticlerubrique()){
							$imagesArt[]=$image;
						}
					}
				}
			}
		}
		
		return array('articles'=>$articles,'imagesArt'=>$imagesArt);
	}
}
