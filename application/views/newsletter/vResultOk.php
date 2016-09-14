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

<div class="row" style="margin-top: 5%">
	<div class="input-field col s10 m5 l5 offset-s1 offset-m1 offset-l1" style="margin-bottom: 15%">
		<label for="selectQst" style="font-size:1.68em; margin-top:-58px;">Question secrète :</label>
		<h4 style="margin-left:-10%"><?=utf8_encode($question)?></h4>
	</div>
	<div class="input-field col s10 m5 l5">
		<?php
			$reponse= array(
					'name'=>'reponse',
					'id'=>'reponse',
					'placeholder'=>'Réponse à la question',
					'style'=>"font-size:1.6em",
					'value'=>"",
					'required'=>'required',
					);
			echo '<label for="reponse"><h5>Réponse</h5></label>';
			echo form_input($reponse);
			echo form_error('reponse','<span class="error" style="color:red">','</span></br>');
		?>
	</div>
</div>
<?php echo form_hidden('abonne',$abonne);?>
<input type="submit" value="Valider" class="btn" style="margin:2%;">
