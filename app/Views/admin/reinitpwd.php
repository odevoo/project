<?php $this->layout('layout', ['title' => 'Change password']) ?>

<?php $this->start('main_content') ?>
    <form class="" method="post" action="<?= $this->url('admin_maj_password') ?>"> 
            <div class="form-group">
            	<input type="hidden" name="id" value="<?= $id ?>" >
                <label for="password">Nouveau mot de passe:</label>
                <input class="form-control" type="password" name="password" id="email" placeholder="">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" name="btn" value="Confirmer">
            </div>
    </form>

<?php $this->stop('main_content') ?>
