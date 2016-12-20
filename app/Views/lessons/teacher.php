<?php $this->layout('layout', ['title' => 'Mes cours']) ?>

<?php $this->start('main_content') ?>

    <h1>Mes cours</h1>
    <?php // debug($_SESSION) ?>
    <!-- Tableau des cours statut 1 -->
    <table class="table table-bordered table-hover table-stripped">
        <caption>Cours en attente de validation</caption>
        <thead>
            <tr class="success">
                <th class="text-center">Date</th>
                <th class="text-center">Heure de début</th>
                <th class="text-center">Heure de fin</th>
                <th class="text-center">Etudiant</th>
                <th class="text-center">Matière</th>
                <th class="text-center">Action</th>



            </tr>
        </thead>
        <tbody>
            <?php foreach ($lessons1 as $key => $lesson1): ?>
            <tr>
                <td class="text-center"><?= date("d-m-Y", strtotime($lesson1['date'])) ?></td>
                <td class="text-center"><?= $lesson1['hstart'] ?>:00</td>
                <td class="text-center"><?= $lesson1['hend'] ?>:00</td>
                <td class="text-center"><?= $lesson1['firstname'] . ' ' . $lesson1['lastname']  ?></td>
                <td class="text-center"><?= $lesson1['name'] ?></td>
                <td class="text-center">
                  <form action="<?= $this->url('lessons_valid') ?>" method="POST">
                        <input type="hidden" name="date" value="<?= date("d-m-Y", strtotime($lesson1['date'])) ?>">
                        <input type="hidden" name="hstart" value="<?= $lesson1['hstart'] ?>:00 H">
                        <input type="hidden" name="id_lesson" value="<?= $lesson1['id_lesson'] ?>">
                        <button class="btn btn-primary" type="">Valider ce cour</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <!-- Tableau des cours statut 2 -->
    <table class="table table-bordered table-hover table-stripped">
        <caption>Cours validés, en attente de paiment</caption>
        <thead>
            <tr class="success">
                <th class="text-center">Date</th>
                <th class="text-center">Heure de début</th>
                <th class="text-center">Heure de fin</th>
                <th class="text-center">Etudiant</th>
                <th class="text-center">Matière</th>




            </tr>
        </thead>
        <tbody>
            <?php foreach ($lessons2 as $key => $lesson2): ?>
            <tr>
                <td class="text-center"><?= date("d-m-Y", strtotime($lesson2['date'])) ?></td>
                <td class="text-center"><?= $lesson2['hstart'] ?>:00</td>
                <td class="text-center"><?= $lesson2['hend'] ?>:00</td>
                <td class="text-center"><?= $lesson2['firstname'] . ' ' . $lesson2['lastname']  ?></td>
                <td class="text-center"><?= $lesson2['name'] ?></td>

            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <!-- Tableau des cours statut 3 -->
    <table class="table table-bordered table-hover table-stripped">
        <caption>Cours payés , en attente de finalisation</caption>
        <thead>
            <tr class="success">
                <th class="text-center">Date</th>
                <th class="text-center">Heure de début</th>
                <th class="text-center">Heure de fin</th>
                <th class="text-center">Etudiant</th>
                <th class="text-center">Matière</th>
                <th class="text-center">Action</th>



            </tr>
        </thead>
        <tbody>
            <?php foreach ($lessons3 as $key => $lesson3): ?>
            <tr>
                <td class="text-center"><?= date("d-m-Y", strtotime($lesson3['date'])) ?></td>
                <td class="text-center"><?= $lesson3['hstart'] ?>:00</td>
                <td class="text-center"><?= $lesson3['hend'] ?>:00</td>
                <td class="text-center"><?= $lesson3['firstname'] . ' ' . $lesson3['lastname']  ?></td>
                <td class="text-center"><?= $lesson3['name'] ?></td>
                <td class="text-center" class="text-center">
                    <button type="button" class="finalize btn btn-primary" data-toggle="modal" data-target="#modal<?= $lesson3['id_lesson'] ?>" data-id="<?= $lesson3['id_lesson'] ?>" >Finaliser ce cour</button>
                    <div class="modal fade bs-example-modal-lg" id="modal<?= $lesson3['id_lesson'] ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                        <div id="modal-finalize" class="modal-dialog modal-lg" role="document">
                            <div class="container modal-content">

                            <form action="<?= $this->url('lessons_finalize') ?>" method="POST">
                                <input type="hidden" name="id_lesson" value="<?= $lesson3['id_lesson'] ?>">

                                <div class="form-group">
                                    <label for="token">Saisissez le token de validation</label>
                                    <input type="text" id="token" class="form-control" name="token" value="" placeholder="">
                                </div>
                                <div class="form-group">
                                    <input class="form-control btn btn-primary" type="submit" name="" class="btn btn-primary" value="Finaliser le cour">
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <!-- Tableau des cours statut 4 -->
    <table class="table table-bordered table-hover table-stripped">
        <caption>Anciens cours</caption>
        <thead>
            <tr class="success">
                <th class="text-center">Date</th>
                <th class="text-center">Heure de début</th>
                <th class="text-center">Heure de fin</th>
                <th class="text-center">Etudiant</th>
                <th class="text-center">Matière</th>




            </tr>
        </thead>
        <tbody>
            <?php foreach ($lessons4 as $key => $lesson4): ?>
            <tr>
                <td class="text-center"><?= date("d-m-Y", strtotime($lesson4['date'])) ?></td>
                <td class="text-center"><?= $lesson4['hstart'] ?>:00</td>
                <td class="text-center"><?= $lesson4['hend'] ?>:00</td>
                <td class="text-center"><?= $lesson4['firstname'] . ' ' . $lesson4['lastname']  ?></td>
                <td class="text-center"><?= $lesson4['name'] ?></td>

            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>


<?php $this->stop('main_content') ?>
