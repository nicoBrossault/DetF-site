<?php
use Doctrine\Common\Persistence\Mapping\Driver\PHPDriver;
use Doctrine\ORM\Query\AST\Functions\SubstringFunction;
?>

<div class="card">
	<?php if(isset($user)):?>
		<div class="utils right-align">
			<span style="margin-right: 1%">
				 <a class="btn-floating waves-effect waves-light" style="background-color:#E0C3F2">
				 	<i class="material-icons">edit</i>
				 </a>
			 </span>
			 <a class="btn-floating waves-effect waves-light" style="background-color:#E0C3F2">
			 	<i class="material-icons">delete</i>
			 </a>
		</div>
	<?php endif;?>
	<div class="card-content">
		<span class="card-title">
			<h1>Présentation</h1>
		</span>
		<div class="row">
			<div class="imgAccueil col s3 m3 l3">
				<img src="<?php echo base_url()?>assets/images/laine.jpg"  
						class="circle responsive-img"
						alt="photo de laine"
						style="
							min-width:150px; 
							min-height:150px; 
							max-width:150px; 
							max-height:150px;
							border-radius:50%;
							background-color:#90caf9; 
							margin-left:3%;">
			</div>
			<div class="contentAccueil col s10 m6 l9 offset-m2">
				<p style="font-size:1.3em"><?=$accueil->getTextSite()?></p>
			</div>
		</div>
	</div>
</div>
</br>
</br>
<div class="row">
	<div class="col l6 m6 s12">
		<div class="card">
			<?php if(isset($user)):?>
				<div class="utils right-align">
					<span style="margin-right: 1%">
						 <a class="btn-floating waves-effect waves-light" style="background-color:#E0C3F2">
						 	<i class="material-icons">edit</i>
						 </a>
					 </span>
					 <a class="btn-floating waves-effect waves-light" style="background-color:#E0C3F2">
					 	<i class="material-icons">delete</i>
					 </a>
				</div>
			<?php endif;?>
			<div class="card-content">
				<span class="card-title">
					<h1><?=$horaire->getTitreTextSite()?></h1>
				</span>
				<div class="row">
					<div class="imgAccueil col s10 m3 l3">
						<img src="<?php echo base_url()?>assets/images/laine.jpg"  
								class="responsive-img"
								alt="photo de la boutique">
					</div>
					<div class="contentAccueil col s10 m6 l9 offset-m2" style="font-size:1.3em">
						<span style="text-align: center"><?=$horaire->getTextSite()?></span>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col l6 m6 s12">
		<div class="card">
			<?php if(isset($user)):?>
				<div class="utils right-align">
					<span style="margin-right: 1%">
						 <a class="btn-floating waves-effect waves-light" style="background-color:#E0C3F2">
						 	<i class="material-icons">edit</i>
						 </a>
					 </span>
					 <a class="btn-floating waves-effect waves-light" style="background-color:#E0C3F2">
					 	<i class="material-icons">delete</i>
					 </a>
				</div>
			<?php endif;?>
			<div class="card-content">
				<span class="card-title">
					<h1><?=utf8_encode($newLetter->getTitreTextSite())?></h1>
				</span>
				<div class="row">
					<div class="contentAccueil col s10 m6 l9 offset-m2" style="font-size:1.3em">
						<span><?=utf8_encode($newLetter->getTextSite())?></span>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>