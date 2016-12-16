<?php $this->layout('layout', ['title' => 'Contact']) ?>

<?php $this->start('main_content') ?>

	<h1>Formulaire de contact</h1>

		<form method="post" action="<?= $this->url('contact_form') ?>">
			<div class="form-group">
                <label for="Nom">Nom</label>
                <input class="form-control" type="texte" name="nom" id="nom" placeholder="votre nom" required>
            </div>
            <div class="form-group">
                <label for="Prenom">Prenom</label>
                <input class="form-control" type="texte" name="prenom" id="prenom" placeholder="votre prenom" required>
            </div>
			<div class="form-group">
                <label for="email">Email</label>
                <input class="form-control" type="email" name="email" id="email" placeholder="votre email" required>
            </div>
            <div class="form-group">
            	<label for="text-area">Votre message</label>
                <textarea class="form-control center-block" type="text-area" name="message" id="message" placeholder="votre texte" rows="6" required></textarea>
            </div>
		    <div class="form-group text-center">
                <input type="submit" class="btn btn-primary" name="btn" value="Envoyer votre message">
            </div>
	</form>

	<div class="social-link text-center">
		<a href="https://www.facebook.com/bootsnipp"><i class="fa fa-facebook-square fa-3x social-fb" id="social"></i></a>
        <a href="https://twitter.com/bootsnipp"><i class="fa fa-twitter-square fa-3x social-tw" id="social"></i></a>
        <a href="https://plus.google.com/+Bootsnipp-page"><i class="fa fa-google-plus-square fa-3x social-gp" id="social"></i></a>
        <a href="mailto:bootsnipp@gmail.com"><i class="fa fa-envelope-square fa-3x social-em" id="social"></i></a>
    </div>                   	

<?php $this->stop('main_content') ?>