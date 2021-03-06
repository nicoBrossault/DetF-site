<?php
use Doctrine\Common\Persistence\Mapping\Driver\PHPDriver;
use Doctrine\ORM\Query\AST\Functions\SubstringFunction;
?>

<div class="card">
	<?php if(isset($user)):?>
		<div class="utils right-align">
			<span style="margin-right: 1%">
				 <a class="btn-floating waves-effect waves-light editRub" 
				 id="<?=$rubrique->getIdrubrique()?>"
				 style="background-color:#E0C3F2">
				 	<i class="material-icons">edit</i>
				 </a>
			 </span>
			 <a id="<?=$rubrique->getIdrubrique()?>"
			 	class="btn-floating waves-effect waves-light btnDeleteRub" 
			 	style="background-color:#E0C3F2">
			 	<i class="material-icons">delete</i>
			 </a>
		</div>
	<?php endif;?>
	<div class="card-content">
		<div class="card-title">
			<?php $itemAlpha=explode('_',$rubrique->getNomrubrique()); ?>
				<div class="iconsMenu" 
					style="
						width: 80px;
						height:80px;
						border-radius:50%;
						background-color:#E9E9E9;
						float:left;
						margin:0px 20px 0px 20px;
						padding:15px 0px 0px 20px; 
						font-size:80px; 
						font-weight:normal;">
						<?=$itemAlpha[0]?>
				</div>
			<h1>
			<?=utf8_encode($itemAlpha[1])?>
			</h1>
		</div>
		<div class="row">
			<div class="imgAccueil col s3 m3 l3">
				<?php if($image != NULL): ?>
				<img src="<?=base_url()?>assets/<?=$image->getUrl()?>"  
						class="circle responsive-img"
						alt="<?php $image->getTitre()?>"
						style="
							min-width:200px; 
							min-height:200px; 
							max-width:200px; 
							max-height:200px;
							border-radius:50%;
							background-color:#90caf9; 
							margin-left:3%;">
				<?php endif;?>
			</div>
			<div class="contentAccueil col s10 m6 l9 offset-m2" style="font-size:2em">
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
						 <a class="btn-floating waves-effect waves-light btnEdit" id="<?=$rubrique->getIdrubrique()."_".$articles->getIdarticlerubrique()?>" style="background-color:#E0C3F2">
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
				<h1><?=utf8_encode($articles->getTitre())?></h1>
			</span>
			<div class="row">
				<div class="imgAccueil col s3 m3 l3">
					<?php 
					$CI =& get_instance();
					$imagesArt=$CI->getImgObj($articles,"articlerubrique");
					if(isset($imagesArt) && !empty($imagesArt) && $imagesArt->getUrl()!="NULL"):?>
							<img src="<?=base_url()?>assets/<?=$imagesArt->getUrl()?>"  
								class="responsive-img"
								alt="<?php $imagesArt->getTitre()?>"
								style="
									min-width:200px; 
									max-width:200px; 
									background-color:#90caf9; 
									margin-left:3%;">
							</br>
					<?php endif;?>
				</div>
				<div class="contentAccueil col s10 m6 l9 offset-m2" style="font-size:2em">
					<p><?=utf8_encode($articles->getTextrubrique())?></p>
				</div>
			</div>
		</div>
	</div>
	<?php endforeach;?>
<?php endif;?>

<?php if(isset($user)):?>
	<div class="buttonAdd valign-wrapper" id="<?=$rubrique->getIdrubrique()."_".NULL?>">
		<span class="center-block valign">
			 <span class="btn-floating waves-effect waves-light add" style="background-color:#ee578c">
			 	<i class="material-icons"><b>add</b></i>
			 </span>
		</span>
	</div>
<?php endif;?>