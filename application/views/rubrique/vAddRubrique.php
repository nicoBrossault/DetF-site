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

<div class="btn annuler btn-floating waves-effect waves-light" style="left:95%">
	<i class="material-icons">close</i>
</div>

<h1>Ajouter / Modifier la Rubrique</h1>
<br>
<br>

<?php
echo form_open_multipart('CFormRubrique');
echo form_hidden('user',$_SESSION['user']);
if(empty($rubrique) || !isset($rubrique)){
	echo form_hidden('idRubrique',NULL);
	$titreRubrique=NULL;
	$texteRubrique=NULL;
	$titreR=NULL;
}else{
	echo form_hidden('idRubrique',$rubrique->getIdrubrique());
	$titreR=$rubrique->getNomrubrique();
	$titreRubrique=substr($titreR,2,strlen($titreR));
	$texteRubrique=$rubrique->getDescriptionrubrique();
};
?>

<div class="input-field col s4 m4">
	<?php $alphaIcons=array("A","B","C","D","E","F","G","H","I");
	foreach($alphaIcons as $alpha):
		if(substr($titreR,0,1)==$alpha):?>
			<input name="alpha" type="radio" id="<?=$alpha?>" value="<?=$alpha?>" checked/>
		<?php else:?>
			<input name="alpha" type="radio" id="<?=$alpha?>" value="<?=$alpha?>"/>
		<?php endif; ?>
    <label for="<?=$alpha?>" class="iconsMenu" 
    style="color:black; margin-left: 1%;">
    	<h2><?=$alpha?></h2>
    	<div style="width:2px; height:100px; background-color:black; margin:-100px 0px 0px 70px"></div>
    </label>
	<?php endforeach; ?>
</div>
</br>
</br>

<?php
$titre= array('name'=>'titre',
		'id'=>'titre',
		'placeholder'=>'Titre de l\'article',
		'style'=>"font-size:1.6em",
		'value'=>utf8_encode($titreRubrique));
echo '<label for="titre"><h5>Titre</h5></label>';
echo form_input($titre);
echo form_error('titre','<span class="error" style="color:red">','</span></br>');
echo "<i>Minimum 5 caractère.</i><br><br>";

?>

<label for="fileImg"><h5>Ajouter une nouvelle Image : </h5></label>
<input type="file" name="fileImg"/>
<br>
<br>
<label for="existImg"><h5>Mettre une Image déjà téléchargé : </h5></label>
<div class="input-field col s12 m6">
	<select class="icons select-wrapper" id="existImg" name="existImg">
		<?php 
		if(isset($imgRub) && !empty($imgRub)){
			foreach($imgRub as $img){
				$imgAR=$img;
			};
		}else{
			$imgAR=NULL;
		}
		$dir = 'assets/images';
		$fileImages = scandir($dir);
		$exist=false;
			
		foreach($fileImages as $fileImage){
			$count+=1;
		}
		
		if($imgAR!=NULL):
		?>
			<option 
				value="<?=$imgAR->getUrl()?>" 
				class="circle" 
				data-icon="<?='assets/'.$imgAR->getUrl()?>"
				selected
				>
				<?=$imgAR->getTitre()?>
			</option>
		<?php endif;?>
		<?php
		for($i=2; $i<$count; $i++):
			$extension = substr($fileImages[$i], -3, 3);
			if($extension == "jpg" || $extension =="png"  || $extension =="JPG" || $extension =="PNG"):
			?>
			<option 
				value="<?=$fileImages[$i]?>" 
				class="circle" 
				data-icon="<?=$dir.'/'.$fileImages[$i]?>">
				<?=$fileImages[$i]?>
			</option>
			<?php endif;?>
		<?php endfor; ?>
		<option value="NULL" <?php if($imgAR==NULL):?>selected <?php endif;?>>Aucune Image</option>
	</select>
</div>
<br>
<br>

<label for="fileImgMark"><h5>Ajouter des marques : </h5></label>
<input type="file" name="fileImgMark[]" multiple/>
<br>
<br>

<label for="texte"><h5>Texte</h5></label>
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
		'value'=>$texteRubrique,
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