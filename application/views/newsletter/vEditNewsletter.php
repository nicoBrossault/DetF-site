<?php
use Doctrine\Common\Persistence\Mapping\Driver\PHPDriver;
use Doctrine\ORM\Query\AST\Functions\SubstringFunction;

echo form_open_multipart('CFormInscription');
echo form_hidden('idTextSite',$textSite->getIdtextsite());
echo form_hidden('user',$_SESSION['user']);
?>
<div class="card">
	<div class="col l6 m12 s12">
		<div class="card">
			<?php if(isset($user)):?>
				<div class="utils right-align">
					<span style="margin-right: 1%">
						<a class="btn-floating waves-effect waves-light btnEditText" 
							id="<?=$newLetter->getIdtextsite()?>"
							style="background-color:#E0C3F2">
							<i class="material-icons">edit</i>
						</a>
					 </span>
				</div>
			<?php endif;?>
			<div class="card-content">
				<span class="card-title">
					<h1><?=utf8_encode($newLetter->getTitreTextSite())?></h1>
				</span>
				<div class="row">
					<div class="contentAccueil col s10 m6 l9 offset-m2" 
					style="font-size:1.3em"
					id="text_<?=$newLetter->getIdtextsite()?>">
						<span><?=utf8_encode($newLetter->getTextSite())?></span>
					</div>
				</div>
				<div class="func btn waves-effect waves-light" id='br' style="margin-left: 5px;">
					<a href="<?=base_url('CNewsletter')?>">S'insrire ?</a>
				</div>
			</div>
		</div>
	</div>
</div>