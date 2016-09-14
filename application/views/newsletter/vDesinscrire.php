<?php
use Doctrine\Common\Persistence\Mapping\Driver\PHPDriver;
use Doctrine\ORM\Query\AST\Functions\SubstringFunction;

echo form_open_multipart('CFormDesinscrire');
?>

<div class="card">
	<div class="col l6 m12 s12">
		<div class="card-content">
			<span class="card-title center-align">
				<h1>Se désinscrire de la Newsletter :</h1>
				<p style="color:red" class="center-align avertis">
					Attention le compte sera supprimé sans possibilité de récupération.
				</p>
			</span>
			<br>
			<br>
			<div class="contentAccueil">
				<div class="row">
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
						?>
						<div class="rechercheMail">
							<div class="btn waves-effect waves-light" id='br' style="margin-left: 5px;">
								<a style="text-decoration:none; color:white" class="recherche">
									Rechercher
								</a>
							</div>
							<div class="msgRec"></div>
						</div>
					</div>
				</div>
				<div class="resultRechOk"></div>
			</div>
		</div>
	</div>
</div>