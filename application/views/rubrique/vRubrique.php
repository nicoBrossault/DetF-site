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
			<h1><?=$rubrique->getNomrubrique()?></h1>
		</span>
		<div class="row">
			<div class="imgAccueil col s3 m3 l3">
				<img src="<?=base_url()?>assets/<?=$image->getUrl()?>"  
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
				<p class="legend"><?=$image->getDescription()?></p>
			</div>
			<div class="contentAccueil col s10 m6 l9 offset-m2" style="font-size:1.3em">
				<p><?=utf8_encode($rubrique->getDescriptionrubrique())?></p>
			</div>
		</div>
	</div>
</div>

<?php if(!empty($articlesImg)):?>
	<?php foreach($articlesImg['articles'] as $articles):?>
		<div class="card">
			<?php if(isset($user)):?>
				<div class="utils right-align">
					<span style="margin-right: 1%">
						 <a class="btn-floating waves-effect waves-light" style="background-color:#E0C3F2">
						 	<i class="material-icons">edit</i>
						 </a>
					 </span>
					 <a class="btn-floating waves-effect waves-light btnDelete" id="<?=$articles->getIdarticlerubrique()?>" style="background-color:#E0C3F2">
					 	<i class="material-icons">delete</i>
					 </a>
				</div>
			<?php endif;?>
		<div class="card-content">
			<span class="card-title">
				<h1><?=$articles->getTitre()?></h1>
			</span>
			<div class="row">
				<div class="imgAccueil col s3 m3 l3">
					<?php foreach($articlesImg['imagesArt'] as $imagesArt):?>
						<?php if($imagesArt->getIdarticlerubrique()->getIdarticlerubrique()==$articles->getIdarticlerubrique()):?>
						<img src="<?=base_url()?>assets/<?=$imagesArt->getUrl()?>"  
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
						</br>
						<p class="legend"><?=$imagesArt->getDescription()?></p>
						<?php endif;?>
					<?php endforeach;?>
				</div>
				<div class="contentAccueil col s10 m6 l9 offset-m2" style="font-size:1.3em">
					<p><?=$articles->getTextrubrique()?></p>
				</div>
			</div>
		</div>
	</div>
	<?php endforeach;?>
<?php endif;?>

<?php if(isset($user)):?>
	<div class="buttonAdd valign-wrapper" id="<?=$rubrique->getIdrubrique()?>">
		<span class="center-block valign">
			 <span class="btn-floating waves-effect waves-light add" style="background-color:#ee578c">
			 	<i class="material-icons"><b>add</b></i>
			 </span>
		</span>
	</div>
<?php endif;?>