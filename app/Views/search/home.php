<?php
//hérite du fichier layout.php à la racine de app/templates/
$this->layout('layout', ['title' => 'Page de recherche'])
?>
<?php
//début du bloc main_content
$this->start('main_content'); ?>



<h2 class="title-search">Les professeurs près de chez vous<h2>
	<div id="js-map-container" class="map"></div>

	<h2 class="title-search">Rechercher par matière<h2>
		<div class="subject-search" >
			<?php $i = 1 ; ?>
			<?php foreach (array_chunk($subjects, 6 , true) as $subjects) : ?>
				<div class="row">

					<?php foreach($subjects as $subject) : ?>
						<?php
						$id = $subject['id'];
						$name = $subject['name'];
						$img = $subject['img'];
						?>
						<div class="col-md-2 col-xs-6">
							<a href="<?= $this->url('search_result',["id" => $id]); ?>">
								<img src="<?php echo $this->assetUrl($img); ?>" class="img-responsive img-rounded img-anim" id="hair<?php echo $i; ?>"   alt="logo" />
								<h4 class="text-center"><?php echo $name ?></h4>
							</a>
						</div>
						<?php $i++; ?>
					<?php endforeach; ?>
				</div>
			<?php endforeach; ?>
		</div>

<input type="hidden" name="" id="id-student" value="<?= $student['id'] ?>">
<input type="hidden" id="img-maps" name="" value="<?= $this->assetUrl('img/pencil-case.png'); ?>">
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDVvV3H3-rcwoX6X-Jq1PXMOhiF-6EyO-E"></script>
<script type="text/javascript" src="<?= $this->assetUrl('js/googlemaps.js') ?>"></script>
<script type="text/javascript" src="<?= $this->assetUrl('js/rotate.js') ?>"></script>

<?php
//fin du bloc
$this->stop('main_content'); ?>