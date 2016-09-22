<?php
use Doctrine\Common\Persistence\Mapping\Driver\PHPDriver;
?>
<script src="<?=base_url()?>assets/js/jquery.js"></script>
<?php
	if(isset($library_src) && isset($script_foot)){
		echo $library_src;
		echo $script_foot;
	}
?>
<script src="<?=base_url()?>assets/js/materialize.min.js"></script>
<?php if(isset($article)):?>
	<h1>Supprimer "<?=utf8_encode($article->getTitre())?>"</h1>
	<a href="<?=base_url('CRubrique')?>/deleteArticle?id=<?=$article->getIdarticlerubrique()?>" class="btn">Valider</a>
<?php endif; ?>
<?php if(isset($rubrique)):?>
	<h1>Supprimer "<?=utf8_encode(substr($rubrique->getNomRubrique(),2))?>"</h1>
	<a href="<?=base_url('CRubrique')?>/deleteRubrique?id=<?=$rubrique->getIdrubrique()?>" class="btn">Valider</a>
<?php endif; ?>
<div class="btn annuler">Annuler</div>