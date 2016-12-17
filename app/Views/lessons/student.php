<?php $this->layout('layout', ['title' => 'Mes cours']) ?>

<?php $this->start('main_content') ?>

    <h1>Mes cours</h1>
    <?php //debug($lessons2) ?>
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
                <td><form action="<?= $this->url('lessons_charge') ?>" method="post">
                        <input type="hidden" name="nb-hours" value="<?= $nbhours = $lesson2['hend']-$lesson2['hstart'] ?>">
                        <input type="hidden" name="amout" value="<?= ($nbhours*$lesson2['price'])*100 ?>">
                        <input type="hidden" name="id_student" value="<?= $_SESSION['user']['id'] ?>">
                        <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                            data-key="<?php echo $stripe['publishable_key']; ?>"
                            data-description="Paiment de votre prochain cours"
                            data-amount="<?= ($nbhours*$lesson2['price'])*100 ?>"
                            data-locale="auto"
                            data-name="Adopte un PROF!"
                            data-image="<?php $this->assetUrl('img/pencil-case.png') ?>"
                            data-label="Payer le cours"
                            data-currency="eur"
                        ></script>
                    </form>
                </td>
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