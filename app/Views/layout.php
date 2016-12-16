<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title><?= $this->e($title) ?></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="<?= $this->assetUrl('css/font-awesome.min.css') ?>">
	<link rel="stylesheet" href="<?= $this->assetUrl('css/style.css') ?>">
</head>
<body>
	<header>
		<div class="container-fluid">
			<nav class="navbar navbar-default navbar-fixed-top">
					<div class="container">

		        <div class="navbar-header">
		        	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
		        		<span class="sr-only">Toggle navigation</span>
		        		<span class="icon-bar"></span>
		        		<span class="icon-bar"></span>
		        		<span class="icon-bar"></span>
		        	</button><a href="<?= $this->url('default_home');?>"><img class="logo" src="<?= $this->assetUrl('img/logo02.png') ?>" /></a>
		        </div>
		        <div id="navbar" class="navbar-collapse collapse">
		        	<ul class="nav navbar-nav">
		            	<li><a href="#"></a></li>
		          	</ul>

		        	<ul class="nav navbar-nav navbar-right">
		        	<?php if (isset($_SESSION['user'])): ?>
		        		<li class="dropdown navbar-align-right">
		              		<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?= $_SESSION['user']['firstname'].' '.$_SESSION['user']['lastname'] ; ?> <span class="caret"></span>
		              		</a>
			              	<ul class="dropdown-menu" id="dropdown-member">
				                <li><a href="<?= $this->url('admin_settings');?>"><i class="fa fa-cog icon" aria-hidden="true"></i> Paramètres </a></li>
				                <li><a href="#"></a></li>
				                <li><a href="#"></a></li>
				                <li role="separator" class="divider"></li>
				                <li class="dropdown-header">Nav header</li>
				                <li><a href="#">Separated link</a></li>
				                <li><a href="<?= $this->url('admin_logout'); ?>"><i class="fa fa-power-off icon" aria-hidden="true"></i> Deconnexion</a></li>
			              	</ul>
		            	</li>
		            	<?php endif; ?>
		            	<?php if (!isset($_SESSION['user'])): ?>
			            	<li class="navbar-align-right"><a href="<?= $this->url('admin_register');?>"><i class="fa fa-paper-plane icon" aria-hidden="true"></i> Inscription</a></li>
			            	<li class="navbar-align-right"><a href="<?= $this->url('admin_login');?>"><i class="fa fa-power-off icon" aria-hidden="true"></i> Connection</a></li>
		            	<?php endif; ?>
		        	</ul>
		        </div>
					</div>
		    </nav>
		</div>
	</header>

	<div class="container">

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
	<footer>
		<div class="row">
			<div class="container text-center">
				<hr />
				<div class="row">
					<div class="col-md-12">
						<div class="col-md-3">
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Mentions Légales</a></li>
							</ul>
						</div>
						<div class="col-md-3">
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#Plan du site">Plan du site</a></li>
							</ul>
						</div>
						<div class="col-md-3">
							<ul class="nav nav-pills nav-stacked">

								<li><a href="<?= $this->url('contact');?>">Contact</a></li>								

							</ul>
						</div>
						<div class="col-md-3">
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#Conditions générales">Conditions générales</a></li>
							</ul>
						</div>
					</div>
				</div>
				<hr />
				<div class="row">
					<div class="col-lg-12">
						<ul class="nav nav-pills nav-justified sub-footer">
							<li>&copy Company Oh ce Cours 2016 </li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</footer>
</body>
</html>
