<?php echo form_open('CFormDelImages'); ?>
<div class="card">
	<div class="card-content">
		<span class="card-title">
			<h1>Gérer les images :</h1>
			<br>
		</span>
		<div class="row">
			<h4>Gestion des Images - <em>Rubrique / Article</em></h4>
			<br>
			<div class="contentAccueil" style="font-size:1.3em; margin-left:10%;">
				<?php foreach($allImages as $image):?>
					<input 
						type="checkbox" 
						name="checkImg[]" 
						id="<?=$image?>" 
						value="<?=$image?>"/>
	    			<label for="<?=$image?>">
			    		<img 
				    		alt="<?=$image?>" 
				    		src="<?php echo base_url()?>assets/images/<?=$image?>"
				    		style="max-width: 50px; height:50px;"
				    		>
    					<div style="
    						width:2px; 
    						height:100px; 
    						background-color:black; 
    						margin:-100px 0px 0px 70px">
    					</div>
    				</label>
    			<?php endforeach;?>
			</div>
			<br>
			<h4>Gestion des Images - <em>Marques</em></h4>
			<br>
			<div class="contentAccueil" style="font-size:1.3em; margin-left:10%;">
				<?php foreach($allImagesMark as $mark):?>
					<input 
						type="checkbox" 
						name="checkImgMark[]" 
						id="<?=$mark?>" 
						value="<?=$mark?>"/>
	    			<label for="<?=$mark?>">
			    		<img 
				    		alt="<?=$mark?>" 
				    		src="<?php echo base_url()?>assets/images/marques/<?=$mark?>"
				    		style="max-width: 50px; height:50px;"
				    		>
    					<div style="
    						width:2px; 
    						height:100px; 
    						background-color:black; 
    						margin:-100px 0px 0px 70px">
    					</div>
    				</label>
    			<?php endforeach;?>
			</div>
			<button class="btn waves-effect waves-light pink lighten-3" type="submit" name="valiser">
				Supprimer
				<i class="material-icons right">send</i>
			</button>
		</div>
	</div>
</div>
<?php echo form_close(); ?>
