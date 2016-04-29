<div class="col s8 m4 offset-s2 offset-m4">
	<div class="card hoverable">
		<div class="card-title pink lighten-3 white-text" style="text-align:center; padding:2%">
			<b>Connexion</b>
		</div>
		<div class="card-content">
			<?php
				echo form_open('formConnexion');

				$mailUser= array('name'=>'mailUser','id'=>'mailUser', 'placeholder'=>'Mail', 'value'=>'');
				echo '<label for="mailUser"><h5>Login</h5></label>';
				echo form_input($mailUser);
				
				$mdp= array('name'=>'mdp','id'=>'mdp','placeholder'=>'Mot de passe', 'value'=>'');
				echo '<label for="mdp"><h5>Mot de Passe</h5></label>';
				echo form_password($mdp);
			?>
				<button class="btn waves-effect waves-light pink lighten-3" type="submit" name="valiser">
					Connexion
					<i class="material-icons right">send</i>
				</button> 
			
			<?php echo form_close(); ?>
		</div>
	</div>
</div>