<?php
	use Doctrine\Common\Persistence\Mapping\Driver\PHPDriver;
?>

<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Douceur &amp; Fantaisie <?=$titre[0]?></title>
		<meta charset="UTF-8">
		<link rel="alternate" href="XXX" hreflang="fr"/>
		<meta name="description" content="Ceci est la page officiel de la boutique Douceur &amp; Fantaisie à Villers-Bocages" />
		<meta name="keywords" content="douceur et fantaisie, douceur & fantaisie, fantasy, douceur & fantasy, laine, vetement enfant, doudou, villers, bocage, normandie,
		katia, achat laine," />
		<!--Import Google Icon Font-->
      	<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/materialize.min.css">
		<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/style.css">
		<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/rangeslider.css">
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
		<script src="<?=base_url()?>assets/js/rangeslider.min.js"></script>
		<script src="<?=base_url()?>assets/js/materialize.min.js"></script>
		
		<div id="wrapper">
			<div class="cache">
				<div class="card formAdd"></div>
			</div>
		
			<div class="headerNav">
				<?php if(isset($user)):?>
					<div class="utils-nav right-align" style="margin:-1% 0% -1% 0%; padding:0.5% 2% 0.5% 0.5%;">
						<h5>
							<span class="s8 m2 l2">
								<a
								href="<?=base_url('CImages')?>"
								class="waves-effect waves-light btn" 
								style="
									text-transform:none;
									font-size:1em;
									border-radius:0;
									background-color:#E0C3F2;
									padding:0px 40px 0px 40px;
									margin:5px 0px 5px 0px;
								">
									Gestion des Images
								</a>
							</span>
							<div class="s8 m2 l2">
								Bonjour, <?=$user->getPrenom()." ".$user->getNom()?>
								<a 
									href="<?=base_url('CAccueil')?>/disconnect"
									class="btn-floating waves-effect waves-light" 
									style="
										background-color:#E0C3F2;
										margin-left: 1%
										">
								 	<i class="material-icons">power_settings_new</i>
								 </a>
							 </div>
						</h5>
					</div>
				<?php endif;?>
				<div class="textHeader s8 m8 l8">
					
					<div id="menu-toggle" class="menuLeft">
						<span class="menuLeft s2 m2 l2">
							<i class="material-icons menuLeftOpen" style="margin-top: 1%; position: absolute;">menu</i>
						</span>
					</div>
					<span class="titreAccueil">
						Douceur & Fantaisie
					</span>
				</div>
				<div class="decoHeader"></div>
			</div>
		
	        <!-- Sidebar -->
	        <div id="sidebar-wrapper">
	            <ul class="sidebar-nav">
	            	<?php if(isset($user)):?>
						</br>
					<?php endif;?>
		  			</br>
					<li id="menu-toggle-bis" class="menuLeft-bis">
						<i class="material-icons menuLeftOpen-bis">
							<span style="margin-left: -12px;">
								close
							</span>
						</i>
					</li>
				<?php foreach($itemsMenu as $item):?>
					<?php if($item=="Accueil"):?>
						<li class="menuItems">
							<a href="<?=base_url()?>">
								<span class="alphaMenu">
									<i class="material-icons" style="margin-left:-15px;">home</i>
								</span>
								<?=$item?>
							</a>
						</li>
					<?php else:?>
						<li class="menuItems">
							<a href="<?=base_url()?>CRubrique?nom=<?=utf8_encode($item)?>">
								<?php $itemAlpha=explode('_',$item); ?>
								<span class="alphaMenu iconsMenu">
									<?=$itemAlpha[0]." "?>
								</span>
								<?=utf8_encode($itemAlpha[1])?>
							</a>
						</li>
					<?php endif;?>
				<?php endforeach;?>
				<?php if(isset($user)):?>
					<br>
					<li class="buttonAddRubrique" id="NULL">
						<span class="btn-floating waves-effect waves-light add" 
						style="background-color:#ad1457; margin-left:100px; margin-top:-5px;">
						 	<i class="material-icons" style="margin-left:-33px;">add</i>
						</span>
					</li>
				<?php endif;?>
	            </ul>
	        </div>
	        <!-- /#sidebar-wrapper -->
		
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
		</div>
	</body>
</html>