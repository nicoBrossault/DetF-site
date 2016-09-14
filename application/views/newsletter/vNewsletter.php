<?php
use Doctrine\Common\Persistence\Mapping\Driver\PHPDriver;
use Doctrine\ORM\Query\AST\Functions\SubstringFunction;

echo form_open_multipart('CFormInscription');
?>

<div class="card">
	<div class="col l6 m12 s12">
		<div class="card">
			<div class="card-content">
				<span class="card-title">
				<h1>S'inscrire à la Newsletter :</h1>
				</span>
				<div class="contentAccueil">
					<p style="font-size:1.3em">Nom</p>
					<p style="font-size:1.3em">Prénom</p>
					<p style="font-size:1.3em">Mail</p>
					<p style="font-size:1.3em">
						Question secrète :
						<select class="icons select-wrapper" id="existImg" name="existImg">
							<?php foreach($questions as $question): ?>
								<option value="<?=$question->getIdQstSecrete()?>">
									<?=$question->getQuestion()?>
								</option>
							<?php endforeach;?>
						</select>
					</p>
				</div>
			</div>
			<input type="submit" name="nom" value="Valider" class="btn" style="margin:2%;">
		</div>
	</div>
</div>

<?php
echo form_close();
?>