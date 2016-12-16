<?php
//hérite du fichier layout.php à la racine de app/templates/
$this->layout('layout', ['title' => 'Profil de '. $teacher['firstname']. ' '. $teacher['lastname']])
?>

<?php
// début du bloc main_content
$this->start('main_content');
// debug($level);
?>

    <div class="container profile-container">
        <div class="row">
            <div class="col-md-12 col-xs-12 ">
              <h1 class="text-align profile-title">Profil de <?= $teacher['firstname']. ' '. $teacher['lastname'] ?></h1>
            </div>
            <div class="col-md-4 col-xs-12">
                <img class="center-block profile-img" src="<?= $this->assetUrl($teacher['avatar']) ?>" alt="">
            </div>
            <div class="col-md-8 col-xs-12 profile-info">
                <p class="text-center "><?= $teacher['description'] ?></p>
            </div>
        </div>

          <hr class="col-md-8 col-md-offset-2 col-xs-8 col-xs-offset-2 profile-hr">
          <div class="row">
            <div class="col-md-12 col-xs-12">
                <h2 class="text-center profile-title">Informations et Matières enseignées</h2>
            </div>
            <div class="container">
              <div class="row">
                <ul class="col-md-5 col-md-offset-1">
                  <?php foreach ($subjects as $subject): ?>
                    <li class="text-center"><?= $subject['name']; ?></li>
                  <?php endforeach; ?>
                </ul>
                <ul class="col-md-5">
                  <li>Tarif : <?= $teacher['price']; ?> €/H</li>
                  <li>Mobilité : <?= $teacher['mobility']; ?></li>
                  <li>Niveau d'enseignemant : <?= $level['level']; ?></li>
                </ul>
              </div>
            </div>
            <hr class="col-md-8 col-md-offset-2 col-xs-8 col-xs-offset-2 profile-hr">
            <div class="row">
              <div class="col-md-12 col-xs-12">
                <h2 class="text-center profile-title">Avis des éleves</h2>
              </div>
            </div>
            <hr class="col-md-8 col-md-offset-2 col-xs-8 col-xs-offset-2 profile-hr">
          <div class="row">
            <div class="col-md-12 col-xs-12">
                <h2 class="text-center profile-title">Reserver un cour avec <?= $teacher['firstname']. ' '. $teacher['lastname'] ?> </h2>
            </div>

            <div class="col-md-3 col-md-offset-1 col-xs-12 ">
                <form action="<?= $this->url('lessons_reservation_form') ?>" method="post">

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
            <div class="col-md-4 col-xs-12">
                    <div class="form-group">
                        <label for="subject">Matière</label>

                        <select class="form-control" id subject name="subject" >
                            <option selected disable value="">Selectionnez une matière</option>
                              <?php foreach ($subjects as $subject): ?>
                                <option value="<?= $subject['id'] ?>"><?= $subject['name']; ?></option>
                              <?php endforeach; ?>

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="subject-learn">Sujet de reflexion :</label>
                        <textarea class="form-control" name="subject-learn" rows="5" cols="47"></textarea>
                        <input type="hidden" name="id_student" value="<?= $_SESSION['user']['id'] ?>">
                        <input type="hidden" name="id_teacher" value="<?= $teacher['id'] ?>">
                    </div>
            </div>
            <div class="col-md-3 col-md-offset-0 col-xs-4 col-xs-offset-4">
                <div class="form-group">
                    <label for="subject">Validation</label>
                    <input type="submit" name="btn" class="btn btn-primary form-control" value="Reservez ce cours" placeholder="">
                </div>
            </div>
          </div>
        </div>



<?php
//fin du bloc
$this->stop('main_content'); ?>
