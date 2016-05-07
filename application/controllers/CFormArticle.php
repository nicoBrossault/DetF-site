<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class FormPage extends CI_Controller {
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
		if(isset($_POST['idPage']) && !empty($_POST['idPage'])){
			$id=$_POST['idPage'];
			//echo "id : ".$id."<br>";
			$this->form_validation->set_rules('idArticle', 'Id de l\'article', 'trim');
			$object = $this->doctrine->em->find('page', $id);
		}else{
			$object = new Page();
		}		
		if(isset($_POST['idUser']) && !empty($_POST['idUser'])){
			//echo "idUser : ".$_POST['idUser']."<br>";
			$idUser=$_POST['idUser'];
			$this->form_validation->set_rules('idUser', 'Id de l\'utilisateur', 'trim');

			$queryUser = $this->doctrine->em->createQuery(
						"SELECT u
						FROM user u
						WHERE u.iduser=".$idUser)->getResult();
			
			foreach($queryUser as $dataUser){
					$object->setIduser($dataUser);
			}
		}
		if(isset($_POST['langue']) && !empty($_POST['langue'])){
			//echo "Recup : ".$_POST['langue']."<br>";
			$postLangue=$_POST['langue'];
			$this->form_validation->set_rules('langue', 'Id de la langue', 'trim');

			//Recuperation de l'objet dans la base;
			$langue=$this->doctrine->em->createQuery("SELECT l FROM langue l")->getResult();

			foreach($langue as $dataLg){
				$test=utf8_encode($dataLg->getLangue());
				//echo "Test : ".$test." = ".$postLangue."<br>";
				if($test==$postLangue){
					//echo "-> this : ".$test." = OK <br>";
					$object->setIdlangue($dataLg);
				}
			}
		}
		if(isset($_POST['date']) && !empty($_POST['date'])){
			//echo "date : ".$_POST['date']."<br>";
			$this->form_validation->set_rules('date', 'Date', 'trim');
			$date = new DateTime($_POST['date']);
			$object->setDate($date);
		}
		if(isset($_POST['titre']) && !empty($_POST['titre'])){
			//echo "titre : ".$_POST['titre']."<br>";
			$this->form_validation->set_rules('titre', 'Titre', 'trim|min_length[5]|xss_clean');
			$object->setTitre(utf8_decode($_POST['titre']));
		}
		if(isset($_POST['texte']) && !empty($_POST['texte'])){
			//echo "texte : ".$_POST['texte']."<br>";
			$this->form_validation->set_rules('texte', 'texte', 'trim|min_length[5]|xss_clean');
			$object->setTexte(utf8_decode($_POST['texte']));
		}
		if(isset($_POST['page']) && !empty($_POST['page'])){
			//echo "page : ".$_POST['page']."<br>";
			$idPage=$_POST['page'];
			$this->form_validation->set_rules('page', 'Id de la page', 'trim');
			//Recuperation de l'objet dans la base;
			$page=$this->doctrine->em->createQuery("SELECT p.idpage FROM page p WHERE p.idpage=".$idPage)->getResult();
			
			foreach($page as $dataPage){
				$object->setIdpage($dataPage['idpage']);				
			}
		}
		if(isset($_FILES['fileImg']['name']) && !empty($_FILES['fileImg']['name'])){
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
		}	
		
		if ($this->form_validation->run() == FALSE){
			//echo 'test false';
			$titre="Page";
			$this->layout->set_titre($titre);
			$this->layout->th_default();
			
			if(isset($id)){
				$object = $this->doctrine->em->createQuery(
							"SELECT p FROM page p WHERE p.idpage=".$id)->getResult();
				$langues = $this->doctrine->em->createQuery("SELECT l FROM langue l")->getResult();
				$this->load->view('page/vEdit',array(
									'page'		=>	$object,
									'langues'	=>	$langues,
									));
			}else{
				$langues = $this->doctrine->em->createQuery("SELECT l FROM langue l")->getResult();
				$this->load->view('page/vAdd',array(
								'page'		=>	$object,
								'langues'	=>	$langues,
								));
			}
		}else{
			//echo 'test true';
			$this->doctrine->em->persist($object);
			$this->doctrine->em->flush();
			redirect('cPage', 'refresh');
		}
	}
}
?>