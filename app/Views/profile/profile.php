<?php
//hérite du fichier layout.php à la racine de app/templates/
$this->layout('layout', ['title' => 'Profil de '. $teacher['firstname']. ' '. $teacher['lastname']])
?>

<?php
// début du bloc main_content
$this->start('main_content');

?>

    <div class="profile-container">
        <div class="row">
            <div class="col-md-12 col-xs-12 ">
              <h1 class="text-align profile-title">Profil de <?= $teacher['firstname']. ' '. $teacher['lastname'] ?></h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-xs-12">
                <img class="center-block profile-img" src="<?= $this->assetUrl($teacher['avatar']) ?>" alt="">
            </div>
            <div class="col-md-8 col-xs-12 profile-info">
                <div class="panel panel-default panel-info">
                    <div class="panel-heading">Biographie</div>
                        <div class="panel-body">
                        <p class="text-center "><?= $teacher['description'] ?></p>
                        </div>
                </div>
            </div>
        </div>


          <hr class="col-md-8 col-md-offset-2 col-xs-8 col-xs-offset-2 profile-hr">
          <div class="row">
            <div class="col-md-12 col-xs-12">
                <h2 class="text-center profile-title">Informations et Matières enseignées</h2>
            </div>
           </div> 
        
              <div class="row">
                <div class="col-md-offset-1 col-md-5">
                    <table class="table table-bordered table-hover table-stripped">
                        <thead>
                            <tr class="info">
                                <th class="text-center">Matières</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($subjects as $subject): ?>
                        <tr class="">
                            <td class="text-center"><?= $subject['name']; ?></td>
                        </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="col-md-5" >
                    <table class="table table-bordered table-hover table-stripped">
                        <thead>
                            <tr class="info">
                                <th class="text-center">Mobilité</th>
                                <th class="text-center">Niveau d'enseignement</th>
                                <th class="text-center">Tarif</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="">
                                <td class="text-center"><?= $teacher['mobility']; ?></td>
                                <td class="text-center"><?= $level['level']; ?></td>
                                <td class="text-center"><?= $teacher['price']; ?> €/H</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="col-md-12 table-city">
                       <table class="table table-bordered table-hover table-stripped">
                        <thead>
                            <tr class="info">
                                <th class="text-center">Ville</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr class="">
                                <td class="text-center"><?= $teacher['city']; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
              </div>
              


            </div>
            <hr class="col-md-8 col-md-offset-2 col-xs-8 col-xs-offset-2 profile-hr">
            <div class="row">
              
                <div class="col-md-6">
                <h2 class="text-center profile-title">Avis des éleves</h2>
                </div>
                <div class="col-md-6">
                <h3 class="profile-title">Notes Moyenne : <?= round($rating['AVG(rating)'],2); ?>/5</h3>
                </div>
              
            </div>

            
                <table class="table table-bordered table-hover table-stripped">
                  <thead>
                    <tr class="info">
                      <th class="col-md-2">Elèves</th>
                      <th class="col-md-1">Matières</th>
                      <th class="col-md-1">Date</th>
                      <th class="col-md-1">Note</th>
                      <th class="col-md-7">Commentaire</th>
                    </tr>
                  </thead>
                  <tbody>
                <?php foreach ($lessons as $lesson): ?>
                  <tr>
                    <td><?= $lesson['firstname']; ?> <?= $lesson['lastname']; ?></td>
                    <td><?= $lesson['name']; ?></td>
                    <td><?= $lesson['date']; ?></td>
                    <td><?= $lesson['rating']; ?></td>
                    <td><?= $lesson['comment']; ?></td>
                  </tr>
                <?php endforeach; ?>
                  </tbody>
                </table>
            
            <hr class="col-md-8 col-md-offset-2 col-xs-8 col-xs-offset-2 profile-hr">
          <div class="row">
            <div class="col-md-12 col-xs-12">
                <h2 class="text-center profile-title">Reserver un cour avec <?= $teacher['firstname']. ' '. $teacher['lastname'] ?> </h2>
            </div>

            <div class="col-md-3 col-md-offset-1 col-xs-12 ">
                <form action="<?= $this->url('lessons_reservation_form') ?>" method="post">
                  <input type="hidden" name="teacher-email" value="<?= $teacher['email'] ?> ">
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
                  </form>
                </div>
            </div>
          </div>
        </div>



<?php
//fin du bloc
$this->stop('main_content'); ?>
