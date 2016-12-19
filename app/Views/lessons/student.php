<?php $this->layout('layout', ['title' => 'Mes cours']) ?>

<?php $this->start('main_content') ?>

    <h1>Mes cours</h1>
    <?php //debug($lessons1) ?>
    <!-- Tableau des cours statut 1 -->
    <table class="table table-bordered table-hover table-stripped">
        <caption>Cours en attente de validation</caption>
        <thead>
            <tr class="success">
                <th class="text-center">Date</th>
                <th class="text-center">Heure de début</th>
                <th class="text-center">Heure de fin</th>
                <th class="text-center">Professeur</th>
                <th class="text-center">Matière</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($lessons1 as $key => $lesson1): ?>
            <tr>
                <td class="text-center" class="text-center"><?= date("d-m-Y", strtotime($lesson1['date'])) ?></td>
                <td class="text-center" class="text-center"><?= $lesson1['hstart'] ?>:00</td>
                <td class="text-center" class="text-center"><?= $lesson1['hend'] ?>:00</td>
                <td class="text-center" class="text-center"><a href="<?= $this->url('profile_show', ['id'=> $lesson1['id_teacher']]); ?>" title=""><?= $lesson1['firstname'] . ' ' . $lesson1['lastname']  ?></a></td>
                <td class="text-center" class="text-center"><?= $lesson1['name'] ?></td>
                <td class="text-center" class="text-center">
                    <form action="<?= $this->url('lessons_cancel') ?>" method="POST">
                        <input type="hidden" name="id_lesson" value="<?= $lesson1['id_lesson'] ?>">
                        <button  type="submit" class="btn-cancel btn btn-danger" type="">Annuler</button>
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
                <th class="text-center">Professeur</th>
                <th class="text-center">Matière</th>
                <th class="text-center">Action</th>



            </tr>
        </thead>
        <tbody>
            <?php foreach ($lessons2 as $key => $lesson2): ?>
            <tr>
                <td class="text-center"><?= date("d-m-Y", strtotime($lesson2['date'])) ?></td>
                <td class="text-center"><?= $lesson2['hstart'] ?>:00</td>
                <td class="text-center"><?= $lesson2['hend'] ?>:00</td>
                <td class="text-center"><a href="<?= $this->url('profile_show', ['id'=> $lesson2['id_teacher']]); ?>" title=""><?= $lesson2['firstname'] . ' ' . $lesson2['lastname']  ?></a></td>
                <td class="text-center"><?= $lesson2['name'] ?></td>
                <td class="text-center"><form action="<?= $this->url('lessons_charge') ?>" method="post">
                        <input type="hidden" name="nb-hours" value="<?= $nbhours = $lesson2['hend']-$lesson2['hstart'] ?>">
                        <input type="hidden" name="amout" value="<?= ($nbhours*$lesson2['price'])*100 ?>">
                        <input type="hidden" name="id_lesson" value="<?= $lesson2['id_lesson'] ?>">
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
            <tr class="success">
                <th class="text-center">Date</th>
                <th class="text-center">Heure de début</th>
                <th class="text-center">Heure de fin</th>
                <th class="text-center">Professeur</th>
                <th class="text-center">Matière</th>
                <th class="text-center">Token</th>
                



            </tr>
        </thead>
        <tbody>
            <?php foreach ($lessons3 as $key => $lesson3): ?>
            <tr>
                <td class="text-center"><?= date("d-m-Y", strtotime($lesson3['date'])) ?></td>
                <td class="text-center"><?= $lesson3['hstart'] ?>:00</td>
                <td class="text-center"><?= $lesson3['hend'] ?>:00</td>
                <td class="text-center"><a href="<?= $this->url('profile_show', ['id'=> $lesson3['id_teacher']]); ?>" title=""><?= $lesson3['firstname'] . ' ' . $lesson3['lastname']  ?></a></td>
                <td class="text-center"><?= $lesson3['name'] ?></td>
                <td class="text-center"><?= $lesson3['token'] ?></td>
                
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
                <th class="text-center">Professeur</th>
                <th class="text-center">Matière</th>
                <th class="text-center">Action / Note</th>
                



            </tr>
        </thead>
        <tbody>
            <?php foreach ($lessons4 as $key => $lesson4): ?>
            <tr>
                <td class="text-center"><?= date("d-m-Y", strtotime($lesson4['date'])) ?></td>
                <td class="text-center"><?= $lesson4['hstart'] ?>:00</td>
                <td class="text-center"><?= $lesson4['hend'] ?>:00</td>
                <td class="text-center"><a href="<?= $this->url('profile_show', ['id'=> $lesson4['id_teacher']]); ?>" title=""><?= $lesson4['firstname'] . ' ' . $lesson4['lastname']  ?></a></td>
                <td class="text-center"><?= $lesson4['name'] ?></td>
                <td class="text-center"><?php if ($lesson4['rating'] == 0): ?>
                    <button type="button" class="rating btn btn-primary" data-toggle="modal" data-target="#modal<?= $lesson4['id_lesson'] ?>" data-id="<?= $lesson4['id_lesson'] ?>">Noter ce cour</button>
                    <?php else: ?> <?= $lesson4['rating'] ?> <?php endif; ?></td>
                    <div class="modal fade bs-example-modal-lg" id="modal<?= $lesson4['id_lesson'] ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="container modal-content">
                            
                            <form action="<?= $this->url('lessons_rating') ?>" method="POST">
                            <input type="hidden" name="id_lesson" value="<?= $lesson4['id_lesson'] ?>">
                            <input type="hidden" id="ratingnote<?= $lesson4['id_lesson'] ?>" name="rating" value="">
                                <div class="form-group">
                                    <label for="rateYo">Votre note sur le cour</label>
                                    <div  data-id="<?= $lesson4['id_lesson'] ?>" class="rateYo"></div>
                                </div>    
                                <div class="form-group">
                                    <label for="comment">Votre avis sur le cour</label>
                                    <textarea  class="form-control" rows="10" name="comment"></textarea>
                                </div>
                                <div class="form-group">
                                    <input class="form-control btn btn-primary" type="submit" name="" class="btn btn-primary" value="Envoyer">
                                </div>
                                
                            </form>
                            
                        </div>
                    </div>
                </div>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

     <script type="text/javascript" src="<?= $this->assetUrl('js/studentlessons.js') ?>"></script>
      

<?php $this->stop('main_content') ?>