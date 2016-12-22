<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title><?= $this->e($title) ?></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.2.0/jquery.rateyo.min.js"></script>
	<link rel="stylesheet" href="<?= $this->assetUrl('css/font-awesome.min.css') ?>">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.2.0/jquery.rateyo.min.css">
	<link rel="stylesheet" href="<?= $this->assetUrl('css/style.css') ?>">
</head>
<body>
	<header>
		<nav class="navbar navbar-default navbar-fixed-top" id="navbar">
			<div class="container navbar-color">
		        <div class="navbar-header">
		        	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-responsive" aria-expanded="false" aria-controls="navbar">
		        		<span class="sr-only">Toggle navigation</span>
		        		<span class="icon-bar"></span>
		        		<span class="icon-bar"></span>
		        		<span class="icon-bar"></span>
		        	</button>
		        	<a class="navbar-brand logo-link" href="<?= $this->url('default_home');?>"><img class="logo" src="<?= $this->assetUrl('img/logo.png') ?>"></a>
		        	<p class="navbar-text" id="brand-text">Oh ce cours !</p>
		        </div>
		        <div  class="navbar-collapse collapse" id="navbar-responsive">
		        	<ul class="nav navbar-nav">
		            	<li><a href="#"></a></li>
		          	</ul>
			        	<ul class="nav navbar-nav navbar-right">
			        	<?php if (isset($_SESSION['user'])): ?>
			        		<li class="dropdown navbar-align-right dropdowncustom">
			              		<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?= $_SESSION['user']['firstname'].' '.$_SESSION['user']['lastname'] ; ?> <span class="caret"></span>
			              		</a>
				              	<ul class="dropdown-menu" id="dropdown-member">
					                <li><a href="<?= $this->url('lessons_page'); ?>"><i class="fa fa-book icon" aria-hidden="true"></i> Mes cours</a></li>
					                <li><a href="<?= $this->url('admin_settings');?>"><i class="fa fa-cog icon" aria-hidden="true"></i> Paramètres </a></li>
					                <?php if ($_SESSION['user']['is_teacher'] == 1 && $_SESSION['user']['is_student'] == 1 ): ?>
	 									<li role="separator" class="divider"></li>
						          		<li><a href="<?= $this->url('admin_subject');?>"><i class="fa fa-user-plus" aria-hidden="true"></i> Admin </a></li>
									<?php endif; ?>
					                <li role="separator" class="divider"></li>
					                <li><a href="<?= $this->url('admin_logout'); ?>"><i class="fa fa-power-off icon" aria-hidden="true"></i> Deconnexion</a></li>
				              	</ul>
			            	</li>
			            	<?php endif; ?>
			            	<?php if (!isset($_SESSION['user'])): ?>
				            	<li class="navbar-align-right logincustom"><a href="<?= $this->url('admin_register');?>"><i class="fa fa-paper-plane icon" aria-hidden="true"></i> Inscription</a></li>
				            	<li class="navbar-align-right logincustom"><a data-placement="bottom" data-toggle="popover" title="Connexion" data-content=""><i class="fa fa-power-off icon" aria-hidden="true"></i> Connexion</a></li>
			            	<?php endif; ?>
			        	</ul>
			        </div>
				</div>
		    </nav>
		</div>
	</header>

	<div class="container contenu">
		
		<div  id="popover_content_wrapper" style="display: none">
			
		
			<form class="" method="post" action="<?= $this->url('admin_process_login') ?>">
            	<div class="form-group">
                	<label for="email">Email</label>
                	<input class="form-control" type="email" name="email" id="email" placeholder="">
            	</div>
            	<div class="form-group">
                	<label for="password">Password</label>
                	<input class="form-control" type="password" name="password" id="password" placeholder="">
					<a href="<?= $this->url('admin_lost_password');?>">Mot de passe perdu ?</a>
            	</div>
            	<div class="form-group">
                	<input type="submit" class="btn btn-success form-control" name="btn" value="Connexion">
            	</div>
    		</form>
    	</div>


		<?php if (isset($_SESSION['flash'])): ?>
	    	<?php foreach ($_SESSION['flash'] as $type => $message): ?>

	        <!--<div class="alert alert-<?= $type; ?>">
	          <?= $message; ?>
	        </div>-->

			<div class="alert alert-<?= $type; ?> alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong><?= $message; ?></strong>
			</div>

	    	<?php endforeach; ?>
	    	<?php unset($_SESSION['flash']); ?>
	    <?php endif ?>
		<section>
			<?= $this->section('main_content') ?>
		</section>
	</div>
	<footer id="footer">
			<div class="container text-center">
				<div class="row">
					<div class="col-md-12">
						<div class="col-md-3">
							<ul class="nav nav-pills nav-stacked">
								<li class="footer-button"><a href="#">Mentions Légales</a></li>
							</ul>
						</div>
						<div class="col-md-3">
							<ul class="nav nav-pills nav-stacked">
								<li class="footer-button"><a href="#Plan du site">Plan du site</a></li>
							</ul>
						</div>
						<div class="col-md-3">
							<ul class="nav nav-pills nav-stacked">
								<li class="footer-button"><a href="<?= $this->url('contact');?>">Contact</a></li>								
							</ul>
						</div>
						<div class="col-md-3">
							<ul class="nav nav-pills nav-stacked">
								<li class="footer-button"><a href="#Conditions générales">Conditions générales</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<ul class="nav nav-pills nav-justified sub-footer">
							<li>&copy Company Oh ce Cours 2016 </li>
						</ul>
					</div>
				</div>
			</div>
	</footer>
	<script type="text/javascript" src="<?= $this->assetUrl('js/login.js') ?>"></script>
</body>
</html>
