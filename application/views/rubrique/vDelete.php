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
<script src="<?=base_url()?>assets/js/general.js"></script>
<script src="<?=base_url()?>assets/js/materialize.min.js"></script>
<h1>Supprimer <?=$article->getTitre()?></h1>
<a href="<?=base_url('CRubrique')?>/deleteArticle?id=<?=$article->getIdarticlerubrique()?>" class="btn">Valider</a>
<div class="btn annuler">Annuler</div>