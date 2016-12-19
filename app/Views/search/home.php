<?php
//hérite du fichier layout.php à la racine de app/templates/
$this->layout('layout', ['title' => 'Page de recherche'])
?>
<?php
//début du bloc main_content
$this->start('main_content'); ?>


 <?php foreach (array_chunk($subjects, 6 , true) as $subjects) : ?>
	<div class="row">

<?php
foreach($subjects as $subject) : ?>
<?php
    $id = $subject['id'];
    $name = $subject['name'];
    $img = $subject['img'];
//    echo $id.'=>'.$name.'=>'.$img.'<br/>';
 ?>
		<div class="col-md-2">
			<a href="<?= $this->url('search_result',["id" => $id]); ?>">
			<img src="<?php echo $this->assetUrl($img); ?>" class="img-responsive img-rounded " alt="logo" />
			<h4 class="text-center"><?php echo $name ?></h4>
			</a>
		</div>


	 <?php endforeach; ?>
	</div>
	 <?php endforeach; ?>





<input type="hidden" name="" id="id-student" value="<?= $student['id'] ?>">
<input type="hidden" id="img-maps" name="" value="<?= $this->assetUrl('img/pencil-case.png'); ?>">
<div style="height:600px;width:100%;" id="js-map-container" class="map"></div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDVvV3H3-rcwoX6X-Jq1PXMOhiF-6EyO-E"></script>
<script type="text/javascript" src="<?= $this->assetUrl('js/googlemaps.js') ?>"></script>
<?php
//fin du bloc
$this->stop('main_content'); ?>