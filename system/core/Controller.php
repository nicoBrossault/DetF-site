<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2015, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (http://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2015, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	http://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Application Controller Class
 *
 * This class object is the super class that every library in
 * CodeIgniter will be assigned to.
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		EllisLab Dev Team
 * @link		http://codeigniter.com/user_guide/general/controllers.html
 */
class CI_Controller {

	/**
	 * Reference to the CI singleton
	 *
	 * @var	object
	 */
	private static $instance;

	/**
	 * Class constructor
	 *
	 * @return	void
	 */
	public function __construct()
	{
		self::$instance =& $this;

		// Assign all the class objects that were instantiated by the
		// bootstrap file (CodeIgniter.php) to local class variables
		// so that CI can run as one big super object.
		foreach (is_loaded() as $var => $class)
		{
			$this->$var =& load_class($class);
		}

		$this->load =& load_class('Loader', 'core');
		$this->load->initialize();
		
		log_message('info', 'Controller Class Initialized');
	}

	// --------------------------------------------------------------------

	/**
	 * Get the CI singleton
	 *
	 * @static
	 * @return	object
	 */
	public static function &get_instance()
	{
		return self::$instance;
	}
	
	public function __connexionAdmin(){
		$data = [];
		$CI =& get_instance();
		$data+=array(	
				'titre'=>"Connexion",
				'itemsMenu'=>array("Accueil"),
				'footer'=>array(
						'footer'=>"",
						'imgMarque'=>array())
		);
		$params['content_for_layout'] = $CI->load->view('accueil/vConnexionAdmin', $data, true);
		$CI->load->view('themeMaterial/material', $params);
	}
	
	public function __disconnect(){
		$uriNameClass=$this->uri->ruri_string();
		$nameClass= explode("/",$uriNameClass);
		session_destroy();
		redirect($nameClass[0],"refresh");
	}
	
	public function isAdmin(){
		if(isset($_SESSION['user']) && !empty($_SESSION['user'])){
			return true;
		}
		return false;
	}
	
	//Récupération de l'image associée à l'article
	public function __getImgArt($article){
		$images=$this->doctrine->em->getRepository('images')->findAll();
		$imagesArt=NULL;
		foreach($images as $image){
			if($image->getIdarticlerubrique()!=NULL){
				if($image->getIdarticlerubrique()->getIdarticlerubrique()==$article->getIdarticlerubrique()){
					$imagesArt[]=$image;
				}
			}
		}
		return $imagesArt;
	}
	
	//Récupération de l'image associée à l'identité
	public function __getImgObj($objet, $entite){
		//echo "function getImgObj (object, $entite): <br>";
		$images=$this->doctrine->em->getRepository('images')->findAll();
		
		$dir = 'application/models';
		$files = scandir($dir);
		
		$debutEntite=substr($entite,0,1);
		$maj=strtoupper($debutEntite);
		$majEntite=$maj.substr($entite,1);
		$minEntite=strtolower($debutEntite).substr($entite,1);
		
		$imagesObj=NULL;
		
		foreach($files as $file){
			$file = substr($file, 0, -4);
			//echo $file."==".$majEntite."<br>";
			if($file==$majEntite){
				//echo "|=> Test Concluant ! <br>";
				$getId="getId".$minEntite;
				foreach($images as $image){
					if($image->$getId()!=NULL){
						if($image->$getId()->$getId()==$objet->$getId()){
							$imagesObj=$image;
							//echo "|=> Image Url : ".$imagesObj->getUrl()."<br>";
						}
					}
				}
				break;
			}
		}
		//echo "--> Sortie Boucle <br>--> Return : ImgObj =>".$imagesObj->getUrl()."<br>";
		return $imagesObj;
	}
	
	public function __addRubrique($id=NULL){
		$data = [];
		/*if($id=="NULL"){
			echo "test null";
		}else{
			echo "essai";
		}*/
		
		if($id!=NULL && $id!="NULL"){
			$rubrique=$this->doctrine->em->find("rubrique",$id);
			
			if(!empty($this->getImgObj($rubrique,"rubrique"))){
				$imgRub=$this->getImgObj($rubrique,"rubrique");
			}else{
				$imgRub=NULL;
			}
			
			$data+=array(
					'rubrique'=>$rubrique,
					"imgRub"=>$imgRub,
			);
		}else{
			$data+=array(
					'rubrique'=>NULL,
			);
		}
		$this->load->view('rubrique/vAddRubrique',$data);
	}
	
	public function __ajaxAddRubrique(){
		$uriNameClass=$this->uri->ruri_string();
		$nameClass= explode("/",$uriNameClass);
		$jFunc='$(".cache").css({
				visibility : "visible",
				height : $(document).height()
				})';
		$this->javascript->getAndBindTo(
				'.buttonAddRubrique',
				'click',
				$nameClass[0].'/addRubrique',
				'.formAdd',
				$jFunc);
		$this->javascript->compile();
	}

}
