<?php
//hérite du fichier layout.php à la racine de app/templates/
$this->layout('layout', ['title' => 'Admin Matières']);
?>
<?php $this->start('main_content') ?>

<div class="container-fluid profile-container">


	<div class="row">

		<table id ="subject-table" class="table table-striped">
		<thead>
			<tr>
				<th class="col-md-1 id-search">Code</th>
				<th class="col-md-1">Img</th>
				<th class="col-md-2">Intitullé</th>
				<th class="col-md-3">Fichier image</th>
				<th class="col-md-1 text-center"></th>
				<th class="col-md-1 text-center"></th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach($subjects as $subject) : ?>
			<?php
			$id = $subject['id'];
			$name = $subject['name'];
			$img = $subject['img'];
			$imgUrl = $this->assetUrl($img);
			?>

			<tr>
				<td class="id-search"><?php echo $id; ?></td>
				<td><img src="<?= $imgUrl; ?>" class="img-miniature img-responsive"></td>
				<form method="post" enctype="multipart/form-data" action="<?= $this->url('admin_update_subject') ?>">
					<input type="hidden" name="id" value="<?=$id; ?>">
					<td><input type="text" name="name" value="<?php echo $name; ?>"></td>
					<td><input class="img-subject" type="file" name="photoSubjects" id="photo" value="<?php echo $img; ?>" class="form-control" accept="image/*"  /></td>
					<td><input id="update-subject" type="submit" name="btnUpdate" value="Modifier" class="btn btn-xs btn-success " /></td>
				</form>
				<td>
					<form method="post" action="<?= $this->url('admin_delete_subject') ?>">
						<input type="hidden" name="id" value="<?=$id; ?>">
						<input type="submit" name="btnSup" value="Supprimer" class="btn btn-xs btn-danger center-block" />
					</form>
				</td>
			</tr>
		<?php endforeach; ?>

			<tr> <!-- affichage de la ligne d'insertion -->
				<form method="post" enctype="multipart/form-data" action="<?= $this->url('admin_insert_subject') ?>">
					<td class="id-search">...</td>
					<td><img src="<?= $this->assetUrl('img/pointint.svg') ?>" class="img-miniature img-responsive"></td>
					<td><input type="text" name="name"></td>
					<td><input class="img-subject" type="file" name="photoSubjects" id="photo"  class="form-control" accept="image/*" required /></td>
					<td></td>
					<td><input type="submit" name="btnSub" value="Ajouter" class="btn btn-xs btn-success center-block" /></td>
				</form>
			</tr>
		</tbody>
		</table>
	</div>
</div>



<?php
//fin du bloc
$this->stop('main_content'); ?>
