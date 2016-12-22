<?php $this->layout('layout', ['title' => 'Settings']) ?>

<?php $this->start('main_content') ?>
        
        <?php if ($_SESSION['user']['is_student'] == 1): ?>
        <h2>Modifier votre profil</h2>
        <form class="" method="post" action="<?= $this->url('admin_update') ?>">
            <div class="form-group">
                <label for="lastname">Nom</label>
                <input class="form-control" type="text" name="lastname" id="lastname" placeholder="" value="<?= $_SESSION['user']['lastname']?>">
            </div>
            <div class="form-group">
                <label for="firstname">Prénom</label>
                <input class="form-control"  type="text" name="firstname" id="firstname" placeholder="" value="<?= $_SESSION['user']['firstname']?>">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input class="form-control" type="password" name="password" id="password" placeholder="">
            </div>
            <div class="form-group">
                <label for="password-confirm">Verification password</label>
                <input class="form-control" type="password" name="password-confirm" id="password-confirm" placeholder="">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input class="form-control" type="email" name="email" id="email" placeholder="" value="<?= $_SESSION['user']['email']?>">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" name="btn" value="Valider mes informations">
            </div>
            <input type="hidden" name="type" value="student">
        </form>
    <?php else: ?>
                <form  method="post" enctype="multipart/form-data" action="<?= $this->url('admin_update') ?>">
            <div class="form-group">
                <label for="lastname">Nom</label>
                <input class="form-control" type="text" name="lastname" id="lastname" placeholder="" value="<?= $_SESSION['user']['lastname']?>">
            </div>
            <div class="form-group">
                <label for="firstname">Prénom</label>
                <input class="form-control"  type="text" name="firstname" id="firstname" placeholder="" value="<?= $_SESSION['user']['firstname']?>">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input class="form-control" type="password" name="password" id="password" placeholder="">
            </div>
            <div class="form-group">
                <label for="password-confirm">Vérification password</label>
                <input class="form-control" type="password" name="password-confirm" id="password-confirm" placeholder="">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input class="form-control" type="email" name="email" id="email" placeholder="" value="<?= $_SESSION['user']['email']?>">
            </div>
            <div class="form-group">
                <label for="price">Tarif horaire</label>
                <input class="form-control" type="number" name="price" id="price" placeholder="" value="<?= $_SESSION['user']['price']?>">
            </div>
            <div class="form-group">
                <label for="desc">Description</label>
                <textarea class="form-control" name="desc" id="desc" placeholder="" rows="10"><?= $_SESSION['user']['description'] ?></textarea>
            </div>
            <div class="form-group">
                <label for="avatar">Avatar</label>
                <input class="form-control" type="file" name="file" id="file" placeholder="" value="<?= $_SESSION['user']['avatar']?>">
            </div>
            <div class="form-group">
                <label for="subjects">Matière</label>
                <?php foreach (array_chunk($subjects, 6 , true) as $subjectschunk): ?>
                    <div class="row">
                        <?php foreach ($subjectschunk as $subject): ?>
                            <?php $i=0; ?>
                            <div class="col-md-2">
                                <input name="<?= $subject['id'] ?>" type="checkbox" <?php if (in_array($subject['id'], $expertise)){ echo 'checked'; } ?> ><?= $subject['name'] ?>
                            </div>
                            <?php $i++;?>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="form-group">
                <label for="level">Niveau maximum enseigné</label>
                <select class="form-control" name="level" id="level">
                    <option selected disabled value="">Selectionnez un niveau</option>
                    <?php foreach ($levels as $level): ?>
                        <option value="<?= $level['id'] ?>"><?= $level['level'] ?></option>}
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="mobility">Mobilité</label>
                <select id="mobility" class="form-control" name="mobility">
                    <option selected disabled value="">Selectionnez votre mobilité</option>
                    <option value="Domicile">Domicile</option>
                    <option value="Chez l'étudiant">Chez l'étudiant</option>
                    <option value="Au choix">Au choix</option>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" name="btn" value="Valider mes informations">
            </div>
            <input type="hidden" name="type" value="teacher">
        </form>
    <?php endif; ?>
<?php $this->stop('main_content') ?>