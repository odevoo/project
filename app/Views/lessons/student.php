<?php $this->layout('layout', ['title' => 'Mes cours']) ?>

<?php $this->start('main_content') ?>

    <h1>Mes cours</h1>
    <?php //debug($lessons) ?>
    <!-- Tableau des cours statut 1 -->
    <table class="table table-bordered table-hover table-stripped">
        <caption>Cours en attente de validation</caption>
        <thead>
            <tr>
                <th>Date</th>
                <th>Heure de début</th>
                <th>Heure de fin</th>
                <th>Professeur</th>
                <th>Matière</th>
                <th>Action<th>



            </tr>
        </thead>
        <tbody>
            <?php foreach ($lessons1 as $key => $lesson1): ?>
            <tr>
                <td><?= date("d-m-Y", strtotime($lesson1['date'])) ?></td>
                <td><?= $lesson1['hstart'] ?>:00</td>
                <td><?= $lesson1['hend'] ?>:00</td>
                <td><?= $lesson1['firstname'] . ' ' . $lesson1['lastname']  ?></td>
                <td><?= $lesson1['name'] ?></td>
                <td><button class="btn btn-danger" type="">Annuler</button></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <!-- Tableau des cours statut 2 -->
    <table class="table table-bordered table-hover table-stripped">
        <caption>Cours validés, en attente de paiment</caption>
        <thead>
            <tr>
                <th>Date</th>
                <th>Heure de début</th>
                <th>Heure de fin</th>
                <th>Professeur</th>
                <th>Matière</th>
                <th>Action<th>



            </tr>
        </thead>
        <tbody>
            <?php foreach ($lessons2 as $key => $lesson2): ?>
            <tr>
                <td><?= date("d-m-Y", strtotime($lesson2['date'])) ?></td>
                <td><?= $lesson2['hstart'] ?>:00</td>
                <td><?= $lesson2['hend'] ?>:00</td>
                <td><?= $lesson2['firstname'] . ' ' . $lesson2['lastname']  ?></td>
                <td><?= $lesson2['name'] ?></td>
                <td><button class="btn btn-danger">Annuler</button></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <!-- Tableau des cours statut 3 -->
    <table class="table table-bordered table-hover table-stripped">
        <caption>Cours payés et validés</caption>
        <thead>
            <tr>
                <th>Date</th>
                <th>Heure de début</th>
                <th>Heure de fin</th>
                <th>Professeur</th>
                <th>Matière</th>
                <th>Action<th>



            </tr>
        </thead>
        <tbody>
            <?php foreach ($lessons3 as $key => $lesson3): ?>
            <tr>
                <td><?= date("d-m-Y", strtotime($lesson2['date'])) ?></td>
                <td><?= $lesson3['hstart'] ?>:00</td>
                <td><?= $lesson3['hend'] ?>:00</td>
                <td><?= $lesson3['firstname'] . ' ' . $lesson2['lastname']  ?></td>
                <td><?= $lesson3['name'] ?></td>
                <td><button class="btn btn-danger">Annuler</button></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <!-- Tableau des cours statut 4 -->
    <table class="table table-bordered table-hover table-stripped">
        <caption>Anciens cours</caption>
        <thead>
            <tr>
                <th>Date</th>
                <th>Heure de début</th>
                <th>Heure de fin</th>
                <th>Professeur</th>
                <th>Matière</th>
                <th>Action<th>



            </tr>
        </thead>
        <tbody>
            <?php foreach ($lessons4 as $key => $lesson4): ?>
            <tr>
                <td><?= date("d-m-Y", strtotime($lesson4['date'])) ?></td>
                <td><?= $lesson4['hstart'] ?>:00</td>
                <td><?= $lesson4['hend'] ?>:00</td>
                <td><?= $lesson4['firstname'] . ' ' . $lesson2['lastname']  ?></td>
                <td><?= $lesson4['name'] ?></td>
                <td><button class="btn btn-danger">Annuler</button></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
      

<?php $this->stop('main_content') ?>