<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CFormRubrique extends CI_Controller {
	public function __construct(){
		// Obligatoire
		parent::__construct();
	}
	
	public function getImgObj($objet, $entite){
		$imgsRub = parent::__getImgObj($objet, $entite);
		
		//echo $imgsRub->getIdimages();
		
		if(!empty($imgsRub)){
			if(count($imgsRub)==1){
				return $imgsRub;
			}else{
				foreach ($imgsRub as $imgRub){
					return $imgRub;
				}
			}
		}else{
			return NULL;
		}
	}
	
	public function getMarqueRub($objet){
		return parent::__getMarqueRub($objet);
	}
	
	public function check_alpha(){
		if(isset($_POST['alpha']) && !empty($_POST['alpha'])){
			return true;
		}else{
			$this->form_validation->set_message('check_alpha','Vous devez cocher une icône !');
			return false;
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
		if(isset($_POST['idRubrique']) && !empty($_POST['idRubrique'])){
			$id=$_POST['idRubrique'];
			//echo "id : ".$id."<br>";
			$this->form_validation->set_rules('idRubrique', 'Id de l\'article', 'trim');
			$object = $this->doctrine->em->find('rubrique', $id);
		}else{
			$object = new Rubrique();
		}
		
		if(isset($_POST['user']) && !empty($_POST['user'])){
			$object->setIduser($this->doctrine->em->find('user',$_POST['user']));
		}
		
		
		//echo 'alpha : '.$_POST['alpha'].'</br>';
		$this->form_validation->set_rules('alpha', 'alpha', 'required|trim|min_length[1]|max_length[1]|xss_clean');
		if(isset($_POST['alpha']) && !empty($_POST['alpha'])){	
			$alpha=$_POST['alpha'];
		}
		
		//echo "titre : ".$_POST['titre']."<br>";
		$this->form_validation->set_rules('titre', 'Titre', 'required|trim|min_length[5]|xss_clean|callback_check_alpha');
		if(isset($alpha)){
			$object->setNomrubrique($alpha."_".utf8_decode($_POST['titre']));
		}
		
		$this->form_validation->set_rules('texte', 'texte', 'required|trim|min_length[5]|xss_clean');
		if(isset($_POST['texte']) && !empty($_POST['texte'])){
			//echo "texte : ".$_POST['texte']."<br>";
			$object->setDescriptionrubrique(utf8_decode($_POST['texte']));
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
				
				if(!empty($this->getImgObj($object,"rubrique"))){
					//echo "l'article a une image </br>";
					$this->doctrine->em->remove($this->getImgArt($object));
				}
				
				$image=new Images();
				$image->setUrl($urlImg);
				$image->setTitre($_POST['titre']);
				$newImg=true;
			}
		}
		
		if(isset($_FILES['fileImgMark']['name']) && !empty($_FILES['fileImgMark']['name'])){
			$file_count=count($_FILES['fileImgMark']['name']);
			
			//echo "test images marques : <br>";
		    //echo "-> Nombre d'images : ".$file_count."</br>";
			//echo "<pre>";
		    //print_r($_FILES['fileImgMark']);
		    //echo "</pre>";
		    
		    $dir = 'assets/images/marques';
			$fileImages = scandir($dir);
			//Si image existe dans le dossier
			//ALORS on ne la télécharge pas -> exist = true
			//Stock url dans $imgMark[]
			$imgMarks=array();
			for ($i=0; $i<$file_count; $i++) {
				$exist=false;
				foreach($fileImages as $fileImage){
					if($fileImage==$_FILES['fileImgMark']['name'][$i]){
						$exist=true;
					}
				 }
				 //echo "existe : ";
				 if($exist){
				 	//echo "1";
				 }else{
				 	//echo "0";
				 }
				 //echo "</br>";
				 
				 if($_FILES['fileImgMark']['name'][$i]==""){
				 	$exist=true;
				 	$newImgMark=false;
				 }
				 
				 if(!$exist){
				 	$config['upload_path'] = 'assets/images/marques';
				 	$config['allowed_types'] = 'gif|jpg|png|jpeg|JPG|PNG|GIF|JPEG';
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					$this->upload->set_allowed_types('*');
					$data['upload_data'] = '';
					
					$_FILES['fileImgMarkUpload']['name']= $_FILES['fileImgMark']['name'][$i];
					$_FILES['fileImgMarkUpload']['type']= $_FILES['fileImgMark']['type'][$i];
					$_FILES['fileImgMarkUpload']['tmp_name']= $_FILES['fileImgMark']['tmp_name'][$i];
					$_FILES['fileImgMarkUpload']['error']= $_FILES['fileImgMark']['error'][$i];
					$_FILES['fileImgMarkUpload']['size']= $_FILES['fileImgMark']['size'][$i];
				
					if (!$this->upload->do_upload('fileImgMarkUpload')){
						//echo "error ! </br>";
						$data = array('msg' => $this->upload->display_errors());
					}else{
						//echo "success ! </br>";
						$data = array('msg' => "Upload success!");
						$data['upload_data'] = $this->upload->data();
					}
					$urlImg='images/marques/'.$_FILES['fileImgMark']['name'][$i];
					
					$marque=new Marque();
					$imgMarks[]=$marque->setUrl($urlImg);
					$newImgMark=true;
				}
			}
			//echo "<pre>";
			//print_r($imgMarks);
			//echo "</pre>";
			
		}
		
		if(isset($_POST['checkMark']) && !empty($_POST['checkMark'])){
			//echo "marque check : <br>";
			$checkMarks=$_POST['checkMark'];
			$alreadyCheck=$this->getMarqueRub($object);
			if(isset($alreadyCheck) && !empty($alreadyCheck)){
			
				$countCheckMark=count($checkMarks);
				//echo "-> count checkMark : ".$countCheckMark."<br>";
				
				$countAlreadyCheckMark=count($alreadyCheck);
				//echo "-> count AlreadycheckMark : ".$countAlreadyCheckMark."<br>";
			
				for($i=0; $i<$countAlreadyCheckMark; $i++){
					//echo "entree boucle : ".$countCheckMark."<br>";
					//echo "<pre>";
					//print_r($checkMarks);
					//echo "</pre>";
					for($j=0; $j<$countCheckMark; $j++){
						if(isset($alreadyCheck[$i]) && substr($alreadyCheck[$i]->getUrl(),15)==$checkMarks[$j]){
							//echo "=> ".$checkMarks[$j]." ==> egal <br>";
							array_splice($checkMarks,$j,1);
							array_splice($alreadyCheck,$i,1);
							$countAlreadyCheckMark=count($alreadyCheck);
							$countCheckMark=count($checkMarks);
							//echo "sortie : ".$countCheckMark."<br><br>";
						}
					}
				}
				
				if(count($checkMarks)==1 || count($alreadyCheck)==1){
					foreach ($alreadyCheck as $acm){
						if(count($checkMarks)!=0){
							if(substr($acm->getUrl(),15)==$checkMarks[0]){
								array_splice($checkMarks,0,1);
								array_splice($alreadyCheck,0,1);
							}
						}
					}
				}
				
				foreach ($alreadyCheck as $acm){
					//echo "-> element retire : ".$acm->getUrl()."<br>";
					$delImgMarks[]=$acm;
					$delMarks=true;
				}
				
				foreach ($checkMarks as $checkMark){
					//echo "-> element ajoute : ".$checkMark."<br>";
					$urlImg='images/marques/'.$checkMark;
					
					$marque=new Marque();
					$imgMarks[]=$marque->setUrl($urlImg);
					$newImgMark=true;
				}
				
				if(count($checkMarks)==0 && count($alreadyCheck)==0){
					$newImgMark=false;
				}
			}else{
				foreach($checkMarks as $checkMark){
					//echo "-> ".$checkMark."<br>";
					$urlImg='images/marques/'.$checkMark;
					
					$marque=new Marque();
					$imgMarks[]=$marque->setUrl($urlImg);
					$newImgMark=true;
				}
			}
		}
		
		if(isset($_POST['existImg']) && !empty($_POST['existImg']) && !isset($newImg)){
			//echo "Recup Img: ".$_POST['existImg']."<br>";
			
			if($_POST['existImg']=="NULL"){
				$emptyImg=true;
			}else{
				$this->form_validation->set_rules('existImg', 'Nom existImg', 'trim');
				$urlImg='images/'.$_POST['existImg'];
				
				$image=new Images();
				$image->setUrl($urlImg);
				$image->setTitre($_POST['titre']);
				$newImg=true;
			}
			
			if(!empty($this->getImgObj($object,'rubrique'))){
				if($_POST['existImg']==$this->getImgObj($object,'rubrique')->getUrl()){
					//echo "Image de la rubrique : ".$_POST['existImg'].'</br>';
					$emptyImg=true;
					$newImg=false;
				}else{
					//permet de changer l'image de l'article
					//$this->doctrine->em->remove($this->getImgObj($object,'rubrique'));
					
					$this->form_validation->set_rules('existImg', 'Nom existImg', 'trim');
					$urlImg='images/'.$_POST['existImg'];
					
					$image=new Images();
					$image->setUrl($urlImg);
					$image->setTitre($_POST['titre']);
					$newImg=true;
				}
			}
		}
		
		if ($this->form_validation->run() == FALSE){
			//echo 'test false';
			if(isset($_POST['idRubrique']) && !empty($_POST['idRubrique'])){
				$titre="Rubrique ".$rubrique->getNomrubrique();
			}else{
				$titre="Rubrique ";
				$rubrique=$object;
			}
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
			
			
			$this->layout->view('rubrique/vAddRubrique',
								array(
									'rubrique'	=>	$rubrique,
								));
		}else{
			//echo 'test true</br>';
			//Update or Put articleRubrique
			$this->doctrine->em->persist($object);
			$this->doctrine->em->flush();
			
			//Put Images
			if(isset($newImg) && $newImg){
				$image->setIdrubrique($this->doctrine->em->find('rubrique',$object->getIdrubrique()));
				$this->doctrine->em->persist($image);
				$this->doctrine->em->flush();
			}
			//Put Images Marks
			if($newImgMark){
				if(!isset($_POST['idRubrique']) || empty($_POST['idRubrique'])){
					foreach ($imgMarks as $marque){
						$this->doctrine->em->persist($marque);
						$this->doctrine->em->flush();
						
						$marquesRubrique=new MarquesRubrique();
						$marquesRubrique->setIdrubrique($this->doctrine->em->find('rubrique',$object->getIdrubrique()));
						//echo $object->getIdrubrique()."<br>";
						$marquesRubrique->setIdmarque($this->doctrine->em->find('marque',$marque->getIdmarque()));
						$this->doctrine->em->persist($marquesRubrique);
						$this->doctrine->em->flush();
					}
				}else{
					foreach ($imgMarks as $marque){
						$this->doctrine->em->persist($marque);
						$this->doctrine->em->flush();
						$countMarque=count($this->doctrine->em->getRepository('marque')->findAll());
						$lastMarque=$this->doctrine->em->find('marque',$countMarque);
						$marquesRubrique=new MarquesRubrique();
						$marquesRubrique->setIdrubrique($this->doctrine->em->find('rubrique',$_POST['idRubrique']));
						$marquesRubrique->setIdmarque($this->doctrine->em->find('marque',$marque->getIdmarque()));
						$this->doctrine->em->persist($marquesRubrique);
						$this->doctrine->em->flush();
					}
				}
			}
			
			//delete img marques
			if(isset($delMarks) && $delMarks){
				foreach($delImgMarks as $del){
					//echo $del->getUrl()."<br>";
					$marquesRub=$this->doctrine->em->getRepository('marquesrubrique')->findAll();
					$this->doctrine->em->remove($del);
					foreach ($marquesRub as $mr){
						//echo $mr->getIdmarque()->getIdmarque()."==".$del->getIdmarque()."<br>";
						
						if($mr->getIdmarque()->getIdmarque()==$del->getIdmarque()){
							//echo "elment a supprimer : ".$mr->getIdmarquesrubrique()."<br>";
							$this->doctrine->em->remove($mr);
							break;
						}
					}
				}
				$this->doctrine->em->flush();
			}
			
			if(isset($emptyImg) && $emptyImg==true){
				
			}
			
			if(isset($_POST['idRubrique']) && !empty($_POST['idRubrique'])){
				$rubrique=$this->doctrine->em->find('rubrique',$_POST['idRubrique']);
			}else{
				$rubrique=$this->doctrine->em->find('rubrique',$object->getIdrubrique());
			}
			redirect('CRubrique?nom='.$rubrique->getNomrubrique(), 'refresh');
		}
	}
}
?>