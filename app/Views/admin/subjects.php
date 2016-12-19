<?php
//hérite du fichier layout.php à la racine de app/templates/
$this->layout('layout', ['title' => 'Admin Matières']);
?>
<?php $this->start('main_content') ?>

<div class="container-fluid profile-container">
	<div class="row">
		<table class="table table-striped">
		<thead>
			<tr>
				<th class="col-md-1 id-search">Code</th>
				<th class="col-md-2">Intitullé</th>
				<th class="col-md-4">Fichier image</th>
				<th class="col-md-1">Action</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach($subjects as $subject) : ?>
			<?php
			$id = $subject['id'];
			$name = $subject['name'];
			$img = $subject['img'];
			?>

			<tr>
				<td class="id-search"><?php echo $id; ?></td>
				<td><input type="text" name="name" value="<?php echo $name; ?>"></td>
				<td><?php echo $img; ?></td>
				<td>
					<form method="post" action="<?= $this->url('admin_delete_subject') ?>">
						<input type="hidden" name="id" value="<?=$id; ?>">
						<input type="submit" name="btnSup" value="Supprimer" class="btn btn-xs btn-danger" /></td>
					</form>
			</tr>
		<?php endforeach; ?>
			<tr>
					<td></td>
					<td></td>
					<td></td>
					<td><input type="submit" name="btnUpd" value="Modifier" class="btn btn-xs btn-success" /></td>
			</tr>
		</tbody>
		</table>

	</div>
</div>

<div class=" container-fluid profile-container subj-container">
	<form method="post" enctype="multipart/form-data" action="<?= $this->url('admin_insert_subject') ?>">
		<div>
			<div class="row">
				<div class="form-group col-md-3 col-md-offset-1">
					<label for="name">Intitulé:</label>
					<input class="form-control" type="text" name="name" id="name" placeholder="" />
				</div>
				<div class="form-group col-md-5 col-md-offset-1">	
					<label for="photo">Image de la matière:</label>
					<input type="file" name="photoSubjects" id="photo"
					class="form-control" accept="image/*" required />
					<!-- l'attribut accept permet de forcer les types de fichiers autorisés -->
				</div>
				<div class="form-group col-md-2">	
				    <label for="">Action</label>
					<input type="submit" name="btnSub" value="Ajouter" class="form-control btn btn-md btn-success" />
				</div>
			</div>
		</div>
	</form>
</div>



<?php
//fin du bloc
$this->stop('main_content'); ?>
