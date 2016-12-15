<?php 
//hérite du fichier layout.php à la racine de app/templates/
$this->layout('layout', ['title' => 'Profil de '. $teacher['firstname']. ' '. $teacher['lastname']])
?>

<?php 
//début du bloc main_content
$this->start('main_content'); ?>
<h1>Profil de <?= $teacher['firstname']. ' '. $teacher['lastname'] ?></h1>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="<?= $this->assetUrl($teacher['avatar']) ?>" alt="">
            </div>
            <div class="col-md-6">
                <?= $teacher['description'] ?>
            </div>
            
        </div>
        <div class="row">
             <h2 class="text-center">Informations sur <?= $teacher['firstname']. ' '. $teacher['lastname'] ?></h2>
            <div class="col-md-6">
                Tarif : <?= $teacher['rating'] ?>€/h
            </div>
        </div>
        <div class="row">
            <h2 class="text-center">Avis sur <?= $teacher['firstname']. ' '. $teacher['lastname'] ?></h2>
        </div>
        <div class="row">
            <h2 class="text-center">Reserver un cour avec <?= $teacher['firstname']. ' '. $teacher['lastname'] ?> </h2>
            <div class="col-md-4">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="date">Jour</label>
                        <input class="form-control" type="date" id="date" name="date" value="" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="hstart">Heure de début</label>
                        <input class="form-control" type="time" id="hstart" name="hstart" value="" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="hend">Heure de fin</label>
                        <input class="form-control" type="time" id="hend" name="hend" value="" placeholder="">
                    </div>
                    
            </div>
            <div class="col-md-4">
                    <div class="form-group">
                        <label for="subject">Matière</label>
                        
                        <select class="form-control" id subject name="subject" >
                            <option selected disable value="">Selectionnez une matière</option>
                            
                        </select>
                    </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="subject">Validation</label>
                    <input type="submit" name="btn" class="btn btn-primary form-control" value="Reservez ce cours" placeholder="">
                </div>
                
                </form>
            </div>
        </div>
        
    </div>

<?php 
//fin du bloc
$this->stop('main_content'); ?>