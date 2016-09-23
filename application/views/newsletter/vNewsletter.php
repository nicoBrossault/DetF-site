<?php
use Doctrine\Common\Persistence\Mapping\Driver\PHPDriver;
use Doctrine\ORM\Query\AST\Functions\SubstringFunction;

echo form_open_multipart('CFormInscription');
?>

<div class="card">
	<div class="col l6 m12 s12">
		<div class="card-content">
			<span class="card-title">
				<h1>S'inscrire à la Newsletter :</h1>
			</span>
			<br>
			<br>
			<div class="contentAccueil">
				<div class="row">
					<div class="input-field col s10 m10 l10 offset-s1 offset-m1 offset-l1">
						<?php
							$nom= array(
									'name'=>'nom',
									'id'=>'nom',
									'placeholder'=>'Votre nom',
									'style'=>"font-size:1.6em",
									'value'=>"",
									'required'=>'required',
									);
							echo '<label for="nom"><h5>Nom : </h5></label>';
							echo form_input($nom);
							echo form_error('nom','<span class="error" style="color:red">','</span></br>');
						?>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s10 m10 l10 offset-s1 offset-m1 offset-l1">
						<?php
							$prenom= array(
									'name'=>'prenom',
									'id'=>'prenom',
									'placeholder'=>'Votre prénom',
									'style'=>"font-size:1.6em",
									'value'=>"",
									'required'=>'required',
									);
							echo '<label for="prenom"><h5>Prénom : </h5></label>';
							echo form_input($prenom);
							echo form_error('prenom','<span class="error" style="color:red">','</span></br>');
						?>
					</div>
				</div>
				<div class="row">
					<?php if(isset($errorMail) && !empty($errorMail)):?>
						<br>
						<br>
						<div class="error" style="color:red; margin-left:5%">
							<h5>/!\ <?=$errorMail?></h5>
						</div>
						<br>
						<br>
					<?php endif;?>
					<div class="input-field col s10 m10 l10 offset-s1 offset-m1 offset-l1">
						<?php
							$mail= array(
									'name'=>'mail',
									'id'=>'mail',
									'type'=>'email',
									'placeholder'=>'Votre Mail',
									'style'=>"font-size:1.6em",
									'value'=>"",
									'required'=>'required',
									);
							echo '<label for="mail"><h5>Mail</h5></label>';
							echo form_input($mail);
							echo form_error('mail','<span class="error" style="color:red">','</span></br>');
						?>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s10 m10 l10 offset-s1 offset-m1 offset-l1">
						<?php
							$mail= array(
									'name'=>'mail2',
									'id'=>'mail2',
									'type'=>'email',
									'placeholder'=>'Votre Mail',
									'style'=>"font-size:1.6em",
									'value'=>"",
									'required'=>'required',
									);
							echo '<label for="mail"><h5>Ecrire de nouveau votre mail</h5></label>';
							echo form_input($mail);
							echo form_error('mail','<span class="error" style="color:red">','</span></br>');
						?>
					</div>
				</div>
				<div class="row" style="margin-top: 5%">
					<div class="input-field col s5 m5 l5 offset-s1 offset-m1 offset-l1">
						<label for="selectQst" style="font-size:1.68em; margin-top:-58px;">Question secrète :</label>
						<select name="selectQst">
							<option value="" disabled selected>Choisissez votre question secrète...</option>
							<?php foreach($questions as $question): 
								$qst=utf8_encode($question->getQuestion());
								$id=$question->getIdQstSecrete();
							?>
								<option value="<?=$id?>"><?=$qst?></option>
							<?php endforeach;?>
						</select>
					</div>
					<div class="input-field col s5 m5 l5">
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
			</div>
			<input type="submit" value="Valider" class="btn" style="margin:2%;">
		</div>
	</div>
</div>

<?php
echo form_close();
?>

<div class="card">
	<div class="col l6 m12 s12 center-align">
		<div class="card-content">
			<span class="card-title">
				<h1>Se désinscrire de la Newsletter ? </h1>
			</span>
			<div class="contentAccueil">
				<div class="btn waves-effect waves-light" id='br' style="margin-left: 5px;">
					<a href="<?=base_url('CNewsletter/desinscrire')?>" style="text-decoration:none; color:white">
						Se Désinscrire
					</a>
				</div>
			</div>
		</div>
	</div>
</div>