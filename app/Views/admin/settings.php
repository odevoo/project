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


<!-- fin de student -->
<?php else: ?>

<!-- debut de teacher -->

<ul class="nav nav-tabs nav-justified">
    <li id="btn-modif" role="presentation" class="active"><a href="#form-modif" type="">Modification profil</a></li>
    <li id="btn-back" role="presentation"><a href="#form-back"   type="">Mes informations</a></li>
</ul>

 <div class="register-container tab-content">
 <div id="form-modif" role="tabpanel" class="tab-pane active">

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
            <div class="col-md-2">
                <input name="<?= $subject['id'] ?>" type="checkbox" <?php if (in_array($subject['id'], $expertise)){ echo 'checked'; } ?>  ><?= $subject['name'] ?>
            </div>
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
</div>
<div id="form-back" role="tabpanel" class="tab-pane">
<div class="row">
    <div class="col-md-6">
     <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Revenu depuis votre inscription</h3>
            </div>
            <div class="panel-body">
                <h1><?= $total ?> € </h1>
            </div>
        </div>

     <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Rapport d'activité</h3>
            </div>
            <div class="panel-body">
                <form action="<?= $this->url('admin_pdf') ?>" method="POST" >
                     <button type="submit" class="btn btn-success">Telecharger le recapitulatif d'activité</button>
                </form>
            </div>
        </div>
        
        <?php if ($_SESSION['user']['rib']): ?>
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Virement</h3>
            </div>
            <div class="panel-body">
                <form action="<?= $this->url('admin_pdf') ?>" method="POST" >
                    <button type="submit" class="btn btn-success">Effectuer un virement</button>
                </form>
            </div>
        </div>
        
    <?php else: ?>

        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Vous devez nous fournir un RIB avant de pourvoir effectuer un virement</h3>

            </div>
            <div class="panel-body">
                <form action="<?= $this->url('admin_pdf') ?>" method="POST" >
                    <button disabled type="submit" class="btn btn-danger">Effectuer un virement</button>
                </form>
            </div>
        </div>

        
    <?php endif; ?>
    </div>
    
    


    <?php if ($_SESSION['user']['rib']): ?>
    <div class="col-md-5">
        
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">RIB</h3>
            </div>
            <div class="panel-body">
                <img class="img-responsive" src="<?= $this->assetUrl($_SESSION['user']['rib']) ?>" alt="">
            </div>
        </div>
        
    </div>
    <div class="col-md-1">
        <form action="<?= $this->url('admin_delete_rib') ?>" method="POST">
            <button class="btn btn-danger" type="">X</button>
        </form>
        
    </div>
    
    <?php else: ?>
        <div class="col-md-6">
   
    
        
        
        <form class="box" method="post" action="<?= $this->url('admin_rib') ?>" enctype="multipart/form-data">
            <div class="box__input">
                <input class="box__file" type="file" name="files[]" id="file" data-multiple-caption="{count} files selected" multiple />
                <label for="file"><strong class="text-center">Glissez-deposer votre RIB à cet emplacement</strong>.</label>
                <button class="box__button" type="submit">Upload</button>
            </div>
            <div class="box__uploading">Uploading&hellip;</div>
            <div class="box__success">Done!</div>
            <div class="box__error">Error! <span></span>.</div>

        </form>
        </div>
    
    </div>
    
    <?php endif; ?>
</div>
<script type="text/javascript" src="<?= $this->assetUrl('js/scriptsettings.js') ?>"></script>
<script type="text/javascript" src="<?= $this->assetUrl('js/settingsrib.js') ?>"></script>
<?php endif; ?>
<?php $this->stop('main_content') ?>