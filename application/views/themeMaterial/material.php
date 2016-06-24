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
		<div class="cache">
			<div class="card formAdd"></div>
		</div>
		<div class="headerNav">
			<?php if(isset($user)):?>
				<div class="utils-nav right-align" style="margin:-1% 0% -1% 0%; padding:0.5% 2% 0.5% 0.5%;">
					<h5>
						<span style="margin-right: 1%">
							Bonjour, <?=$user->getPrenom()." ".$user->getNom()?>
						</span>
						<a 
							href="<?=base_url('CAccueil')?>/disconnect"
							class="btn-floating waves-effect waves-light" 
							style="background-color:#E0C3F2">
						 	<i class="material-icons">power_settings_new</i>
						 </a>
					</h5>
				</div>
			<?php endif;?>
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
		
		<div class="menuNav z-depth-3">
	  		<ul class="sideNav">
	  			<?php if(isset($user)):?>
					</br>
				<?php endif;?>
	  			</br>
				<?php foreach($itemsMenu as $item):?>
					<?php if($item=="Accueil"):?>
						<li class="menuItems">
							<a href="<?=base_url()?>" style="width:200px;"> 
								<?php echo $item ?>
							</a>
						</li>
					<?php else:?>
						<li class="menuItems">
							<a href="<?=base_url()?>CRubrique?nom=<?=$item?>">
								<?=$item ?>
							</a>
						</li>
					<?php endif;?>
				<?php endforeach;?>
				<?php if(isset($user)):?>
					<br>
					<div class="buttonAddRubrique">
						<span class="btn-floating waves-effect waves-light add" 
						style="background-color:#ee578c; margin-left:40%">
						 	<i class="material-icons"><b>add</b></i>
						</span>
					</div>
				<?php endif;?>
			</ul>
		</div>
		
		<div class="contentText col s10 m10 l9offset-s1 offset-m1 offset-l3 "
			<?php if(isset($user)):?>
				style="margin-top: 5%;"
			<?php endif;?>
		>	
			<div id="content">
				<?php echo $content_for_layout; ?>
			</div>
			<br><br>
		</div>
		
		<div class='footer'>
			<div class="pied">
				<?php foreach ($footer['imgMarque'] as $img):?>
					<img src="<?=base_url()."assets/".$img?>" 
						alt="logo" 
						class="responsive-img" 
						style="max-height:60px">
				<?php endforeach;?>
				<?php echo utf8_encode($footer['footer'])?>
			</div>
		</div>
	</body>
</html>