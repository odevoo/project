<?php $this->layout('layout', ['title' => 'Connection']) ?>

<?php $this->start('main_content') ?>
    <form class="" method="post" action="<?= $this->url('admin_process_login') ?>">
            <div class="form-group">
                <label for="email">Email</label>
                <input class="form-control" type="email" name="email" id="email" placeholder="">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input class="form-control" type="password" name="password" id="password" placeholder="">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" name="btn" value="Connexion">
            </div>
            <input type="hidden" name="type" value="student">
    </form>
<?php $this->stop('main_content') ?>
