<?php
//hérite du fichier layout.php à la racine de app/templates/
$this->layout('layout', ['title' => 'Page de recherche'])
?>
<?php
//début du bloc main_content
$this->start('main_content'); ?>
<?php
foreach($subjects as $subject){
    $id = $subject['id'];
    $name = $subject['name'];
    echo $id.'=>'.$name.'<br/>';
}
?>
<input type="hidden" name="" id="id-student" value="<?= $student['id'] ?>">
<input type="hidden" id="img-maps" name="" value="<?= $this->assetUrl('img/pencil-case.png'); ?>">
<div style="height:900px;width:100%;" id="js-map-container" class="map"></div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDVvV3H3-rcwoX6X-Jq1PXMOhiF-6EyO-E"></script>
<script type="text/javascript" src="<?= $this->assetUrl('js/googlemaps.js') ?>"></script>
<?php
//fin du bloc
$this->stop('main_content'); ?>