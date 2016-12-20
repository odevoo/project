<?php $this->layout('layout', ['title' => 'Resultat de la recherche']) ?>

<?php $this->start('main_content') ?>

	<h1>Resultat de votre recherche :</h1>

<?php 
	//debug($teachers);
	foreach ($teachers as $teacher):?>

	<div class="profile-container">
		<div class="row">
			<div class="col-xs-12 col-md-2">
				<img class="img-responsive avatar center-block" src="<?= $this->assetUrl($teacher['avatar']); ?>">
			</div>
			<div class="col-md-8" >
				<h3 class=""><?= $teacher['firstname'].' '.$teacher['lastname']; ?> </h3>
				<table class="table table-bordered">
					<thead>
						<tr class="info">
							<th class="col-md-4">Localisation : </th>
							<th class="col-md-4">Niveau d'étude :</th>
							<th class="col-md-4">Tarifs :</th>
						</tr>
					</thead>
					<tbody>
						<tr>					
							<td class="col-md-4"><?= $teacher['postcode']; ?> <?= $teacher['city']; ?></td>
							<td class="col-md-4"><?= $teacher['level']; ?> </td>
							<td class="col-md-4"><?= $teacher['price']; ?> €/heure</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="col-md-2 search-form text-center">
	   			<a href="<?= $this->url('profile_show', ['id'=> $teacher['id_teacher']]); ?>"><button type="submit" id="btn-search" class="btn btn-search-custom">
	   			Voir profil</button></a>
			</div>
			</div>
		
	</div>
<?php
    endforeach;
?>

<?php $this->stop('main_content') ?>