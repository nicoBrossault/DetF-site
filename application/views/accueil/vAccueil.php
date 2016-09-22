<?php
use Doctrine\Common\Persistence\Mapping\Driver\PHPDriver;
use Doctrine\ORM\Query\AST\Functions\SubstringFunction;
?>

<div class="card">
	<?php if(isset($user)):?>
		<div class="utils right-align">
			<span style="margin-right: 1%">
				<a class="btn-floating waves-effect waves-light btnEditPromo" 
				 	id="promo"
				 	style="background-color:#E0C3F2">
					<i class="material-icons">edit</i>
				</a>
			</span>
		</div>
	<?php endif;?>
	<?php if($promo->getActif()!=0):?>
		<div class="card-content editPromo center-align carton" style="color:white">
			<span class="card-title center-align">
				<h1><?=$promo->getLibellepromo()?></h1>
			</span>
			<div class="contentAccueil center-align promoContent">
				<p style="font-size:1.3em"><?=$promo->getTextpromo()?></p>
			</div>
		</div>
	<?php 
		endif;
		if($promo->getActif()==0 && isset($user)):
	?>
		<div class="card-content editPromo">
			<p class="center-align" style="font-size:3em">
				Aucune <em>"Promotion"</em> ou <em>"Nouvelle"</em> actif...
			<p>
		</div>
	<?php endif;?>
</div>
<br>
<br>

<div class="card">
	<?php if(isset($user)):?>
		<div class="utils right-align">
			<span style="margin-right: 1%">
				 <a class="btn-floating waves-effect waves-light btnEditText" 
				 	id="<?=$accueil->getIdtextsite()?>"
				 	style="background-color:#E0C3F2">
				 	<i class="material-icons">edit</i>
				 </a>
			 </span>
		</div>
	<?php endif;?>
	<div class="card-content">
		<span class="card-title">
			<h1><?=utf8_encode($accueil->getTitretextsite())?></h1>
		</span>
		<div class="row">
			<div class="imgAccueil col s3 m3 l3">
				<img src="<?php echo base_url()?>assets/images/laine.jpg"  
						class="circle responsive-img"
						alt="photo de laine"
						style="
							min-width:200px; 
							min-height:200px; 
							max-width:200px; 
							max-height:200px;
							border-radius:50%;
							background-color:#90caf9; 
							margin-left:3%;">
			</div>
			<div class="contentAccueil col s10 m6 l9 offset-m2" 
			style="font-size:2em"
			id="text_<?=$accueil->getIdtextsite()?>">
				<p style="font-size:1.3em"><?=utf8_encode($accueil->getTextSite())?></p>
			</div>
		</div>
	</div>
</div>
</br>
</br>
<div class="row">
	<div class="col l6 m12 s12">
		<div class="card">
			<?php if(isset($user)):?>
				<div class="utils right-align">
					<span style="margin-right: 1%">
						 <a class="btn-floating waves-effect waves-light btnEditText"
						 	id="<?=$horaire->getIdtextsite()?>"
						 	style="background-color:#E0C3F2">
						 	<i class="material-icons">edit</i>
						 </a>
					 </span>
				</div>
			<?php endif;?>
			<div class="card-content">
				<span class="card-title">
					<h1><?=utf8_encode($horaire->getTitreTextSite())?></h1>
				</span>
				<div class="row">
					<div class="imgAccueil col s12 m6 l6">
						<img src="<?php echo base_url()?>assets/images/systemImg/laineMag.jpg"  
								class="responsive-img"
								alt="photo de la boutique";"
							>
					</div>
					<div class="contentAccueil col s12 m6 l6" 
					style="font-size:2em"  
					id="text_<?=$horaire->getIdtextsite()?>">
						<span style="text-align: center"><?=utf8_encode($horaire->getTextSite())?></span>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col l6 m12 s12">
		<div class="card">
			<?php if(isset($user)):?>
				<div class="utils right-align">
					<span style="margin-right: 1%">
						<a class="btn-floating waves-effect waves-light btnEditText" 
							id="<?=$newLetter->getIdtextsite()?>"
							style="background-color:#E0C3F2">
							<i class="material-icons">edit</i>
						</a>
					 </span>
				</div>
			<?php endif;?>
			<div class="card-content">
				<span class="card-title">
					<h1><?=utf8_encode($newLetter->getTitreTextSite())?></h1>
				</span>
				<div class="row">
					<div class="contentAccueil col s10 m6 l9 offset-m2" 
					style="font-size:2em"
					id="text_<?=$newLetter->getIdtextsite()?>">
						<span><?=utf8_encode($newLetter->getTextSite())?></span>
					</div>
				</div>
				<div class="btn waves-effect waves-light" id='br' style="margin-left: 5px;">
					<a href="<?=base_url('CNewsletter')?>" style="text-decoration:none; color:white">S'insrire ?</a>
				</div>
			</div>
		</div>
	</div>
</div>