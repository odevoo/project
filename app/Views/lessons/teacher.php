<?php $this->layout('layout', ['title' => 'Mes cours']) ?>

<?php $this->start('main_content') ?>

    <h1>Mes cours</h1>
    <?php //debug($lessons) ?>
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
                <td class="text-center"><button class="btn btn-primary" type="">Valider ce cour</button></td>
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
                <td class="text-center" class="text-center"><button class="btn btn-primary">Finaliser ce cour</button></td>
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