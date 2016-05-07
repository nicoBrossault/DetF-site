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

<h1>Ajouter / Modifier un Article de la Rubrique</h1>
<br>
<br>

<?php
echo form_open('CFormArticle');
echo form_hidden('idArticle',NULL);
echo form_hidden('idRubrique',$rubrique->getIdrubrique());
?>

<?php
$titre= array('name'=>'titre',
		'id'=>'titre',
		'placeholder'=>'Titre de l\'article',
		'style'=>"font-size:1.6em",
		'value'=>'',);
echo '<label for="titre"><h5>Titre</h5></label>';
echo form_input($titre);
echo form_error('titre','<span class="error" style="color:red">','</span></br>');
echo "<i>Minimum 5 caractère.</i><br><br><br><br>";

?>
<label for="texte"><h5>Texte</h5></label>
<div class="row">
	<div class="func col s2 m2 l2 btn waves-effect waves-light" id='u' style="margin-left: 5px;">
		<div class="tooltipped" data-position="top" data-delay="50" data-tooltip="Souligne : écrire entre les balises">
			<i class="material-icons">format_underlined</i>
		</div>
	</div>
	<div class="func col s2 m2 l2 btn waves-effect waves-light" id='i' style="margin-left: 5px;">
		<div class="tooltipped" data-position="top" data-delay="50" data-tooltip="Met en Italique : écrire entre les balises">
			<i class="material-icons">format_italic</i>
		</div>
	</div>
	<div class="func col s2 m2 l2 btn waves-effect waves-light" id='b' style="margin-left: 5px;">
		<div class="tooltipped" data-position="top" data-delay="50" data-tooltip="Met en Gras : écrire entre les balises">
			<i class="material-icons">format_bold</i>
		</div>
	</div>
	<div class="func col s2 m2 l2 btn waves-effect waves-light" id='br' style="margin-left: 5px;">
		<div class="tooltipped" data-position="top" data-delay="50" data-tooltip="Saut de ligne : Ne pas écrire entre les balises">
			<i class="material-icons">wrap_text</i>
		</div>
	</div>
</div>
<?php
$texte= array(
		'name'=>'texte',
		'id'=>'texte',
		'class'=>"materialize-textarea article",
		'style'=>"font-size:1.6em",
		'placeholder'=>'Texte de l\'article',
		'value'=>'',
		'cols' => '40',
		'rows' => '40');
echo form_textarea($texte);
echo form_error('texte','<span class="error" style="color:red">','</span></br>');
echo '<div id="legende"></div>';
?>

<input type="submit" name="nom" value="Valider" class="btn">
<div class="btn annuler">Annuler</div>
<?php
echo form_close();
?>