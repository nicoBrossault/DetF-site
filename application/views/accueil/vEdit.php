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

<?php
echo form_open_multipart('CFormText');
echo form_hidden('idTextSite',$textSite->getIdtextsite());
?>


<h2>Modifier le titre : </h2>
<br>
<?php
$titre= array(
		'name'=>'titre',
		'id'=>'titre',
		'style'=>"font-size:1.6em",
		'placeholder'=>'Titre du texte', 
		'value'=>utf8_encode($textSite->getTitretextsite())
		);
echo form_input($titre);
echo form_error('texte','<span class="error" style="color:red">','</span></br>');
echo '<div id="legende"></div>';
?>

<h2>Modifier le texte : </h2>
<br>
<div class="row">
	<div class="func col s2 m2 l2 btn waves-effect waves-light" id='p' style="margin-left: 5px;">
		<div class="tooltipped" data-position="top" data-delay="50" data-tooltip="Paragraphe : écrire entre les balises">
			<i class="material-icons">format_align_left</i>
		</div>
	</div>
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
		'value'=>utf8_encode($textSite->getTextsite()),
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