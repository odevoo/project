<?php $this->layout('layout', ['title' => 'Resultat de la recherche']) ?>

<?php $this->start('main_content') ?>


	<h1>Page recherche</h1>

	
<?php 
	debug($teachers);
	foreach ($teachers as $teacher):?>

	<div class="container-fluid profile-container">
		<div class="row">
			<div class="col-md-2">
				<img class="img-responsive" src="<?= $this->assetUrl($teacher['avatar']); ?>">
			</div>

			<div class="col-md-8 container-fluid" >
				<div class="row">
					<h3 class="col-md-12"><?= $teacher['firstname'].' '.$teacher['lastname']; ?> </h3>
					<table class ="table">
						<td class="col-md-4"><?= $teacher['postcode']; ?> <?= $teacher['city']; ?></td>
						<th class="col-md-4"><?= $teacher['level']; ?> </th>
						<th class="col-md-4"><?= $teacher['price']; ?> €/H</th>
					</table>
				</div>
			</div>
			<div class="container-fluid col-md-2 search-form text-center">
	   			<a href="<?= $this->url('profile_show', ['id'=> $teacher['id_teacher']]); ?>"><button type="submit" id="btn-search" class="btn btn-custom btn-large">
	   			Voir profil</button></a>
			</div>
		</div>
	</div>
<?php
    endforeach;
?>

<?php $this->stop('main_content') ?>