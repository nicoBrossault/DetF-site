<?php
	use Doctrine\Common\Persistence\Mapping\Driver\PHPDriver;
?>
<!DOCTYPE html>
	<head>
		<title>d&f <?=$titre?></title>
		<meta charset="UTF-8">
		<!--Import Google Icon Font-->
      	<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/materialize.min.css">
		<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/style.css">
		<link rel="icon" type="image/png" href="<?=base_url()?>assets/images/favicon.png" />
		<link href='https://fonts.googleapis.com/css?family=Grand+Hotel' rel='stylesheet' type='text/css'>
	</head>
	<body>
		<script src="<?=base_url()?>assets/js/jquery.js"></script>
		<?php
			if(isset($library_src) && isset($script_foot)){
				echo $library_src;
				echo $script_foot;
			}
		?>
		<script src="<?=base_url()?>assets/js/general.js"></script>
		<script src="<?=base_url()?>assets/js/materialize.min.js"></script>
		<div class="headerNav row	">
			<div class="textHeader s8 m8 l8">
				<span class="menuLeft s2 m2 l2">
					<i class="material-icons menuLeftOpen">menu</i>
					<i class="material-icons menuLeftClose">menu</i>
				</span>
				<span class="titreAccueil">
					Douceur & Fantaisie
				</span>
			</div>
			<div class="decoHeader"></div>
		</div>
		
		<div class="menuNav">
	  		<ul class="sideNav">
	  		</br>
				<li>
					test1
				</li>
				<li>
					test2
				</li>
				<li>
					test3
				</li>
			</ul>
		</div>
			
		<div class="row">
			<div class="col s10 m10 l9 offset-s1 offset-m1 offset-l3">	
			