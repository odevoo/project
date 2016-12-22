<?php $this->layout('layout', ['title' => 'Lost password']) ?>

<?php $this->start('main_content') ?>
    <form class="" method="post" action="<?= $this->url('admin_reset_password') ?>">
            <div class="form-group">
                <label for="email">Email</label>
                <input class="form-control" type="email" name="email" id="email" placeholder="">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" name="btn" value="Envoyer">
            </div>
    </form>
<?php $this->stop('main_content') ?>
