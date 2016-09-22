<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CFormDelImages extends CI_Controller {
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
		
		if(isset($_POST['checkImg']) && !empty($_POST['checkImg'])){
			$checkImg=$_POST['checkImg'];
			//echo "<pre>";
			//print_r($checkImg);
			//echo "</pre>";
			
			$imagesBdd=$this->doctrine->em->getRepository('images')->findAll();
			foreach($checkImg as $img){
				foreach ($imagesBdd as $imgBdd){
					//echo $imgBdd->getUrl()."<br>";
					if($img==substr($imgBdd->getUrl(),7)){
						//echo "=> test conclant <br>";
						if(!empty($imgBdd->getIdarticlerubrique())){
							//echo "=> article rubrique<br>";
							$imgBdd->setIdarticlerubrique(NULL);
							$this->doctrine->em->persist($imgBdd);
							$this->doctrine->em->flush();
						}
						if(!empty($imgBdd->getIdrubrique())){
							//echo "=> rubrique <br>";
							$imgBdd->setIdrubrique(NULL);
							$this->doctrine->em->persist($imgBdd);
							$this->doctrine->em->flush();
						}
						if(!empty($imgBdd->getIdtextsite())){
							//echo "=> text site <br>";
							$imgBdd->setIdtextsite(NULL);
							$this->doctrine->em->persist($imgBdd);
							$this->doctrine->em->flush();
						}
						if(!empty($imgBdd->getIdpromo())){
							//echo "=> promo <br>";
							$imgBdd->setIdpromo(NULL);
							$this->doctrine->em->persist($imgBdd);
							$this->doctrine->em->flush();
						}
					}
				}
			}
			
			foreach($checkImg as $img){
				unlink("assets/images/".$img);
			}
		}
		
		if(isset($_POST['checkImgMark']) && !empty($_POST['checkImgMark'])){
			$checkImgMark=$_POST['checkImgMark'];
			//echo "<pre>";
			//print_r($checkImgMark);
			//echo "</pre>";
			$marqueBdd=$this->doctrine->em->getRepository('marque')->findAll();
			$markRub=$this->doctrine->em->getRepository('marquesrubrique')->findAll();
			foreach($checkImgMark as $mark){
				foreach ($marqueBdd as $markBdd){
					//echo $markBdd->getUrl()."<br>";
					if($mark==substr($markBdd->getUrl(),15)){
						//echo "=> test conclant <br>";
						$this->doctrine->em->remove($markBdd);
						foreach($markRub as $mr){
							if($mr->getIdmarque()->getIdmarque()==$markBdd->getIdMarque()){
								//echo $markBdd->getIdMarque()."<br>";
								$this->doctrine->em->remove($markBdd);
								$this->doctrine->em->remove($mr);
							}
						}
						$this->doctrine->em->flush();
					}
				}
			}
			
			foreach($checkImgMark as $mark){
				unlink("assets/images/marques/".$mark);
			}
		}
		redirect('CImages', 'refresh');
	}
}
?>