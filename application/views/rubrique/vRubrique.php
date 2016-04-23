<?php
use Doctrine\Common\Persistence\Mapping\Driver\PHPDriver;
use Doctrine\ORM\Query\AST\Functions\SubstringFunction;
?>

<div class="card">
	<div class="card-content">
		<span class="card-title">
			<h1><?=$rubrique->getNomrubrique()?></h1>
		</span>
		<div class="row">
			<div class="imgAccueil col s3 m3 l3">
				<img src="<?=base_url()?>assets/<?=$image?>"  
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
			<div class="contentAccueil col s10 m6 l9 offset-m2" style="font-size:1.3em">
				<p><?=utf8_encode($rubrique->getDescriptionrubrique())?></p>
			</div>
		</div>
	</div>
</div>

<?php foreach($articlesImg as $articleImg):?>
	<?php //print_r($articleImg)?>
	<div class="card">
	<div class="card-content">
		<span class="card-title">
			<h1></h1>
		</span>
		<div class="row">
			<div class="imgAccueil col s3 m3 l3">
				<img src=""  
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
			<div class="contentAccueil col s10 m6 l9 offset-m2" style="font-size:1.3em">
				<p></p>
			</div>
		</div>
	</div>
</div>
<?php endforeach;?>