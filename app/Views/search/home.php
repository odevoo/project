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




<?php 
//fin du bloc
$this->stop('main_content'); ?>