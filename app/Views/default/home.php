<?php $this->layout('layout', ['title' => 'Accueil']) ?>

<?php $this->start('main_content') ?>

	<?php //debug($profs); ?>
	<!--<div class="main-text">
		<div class="text-center">
			<h1 class="slider-title">
				Nos Prestations Générales
			</h1>							
		</div>
	</div>-->
	<div class="row">
		<div class="">
			<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
				<ol class="carousel-indicators">
					<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
					<li data-target="#carousel-example-generic" data-slide-to="1"></li>
					<li data-target="#carousel-example-generic" data-slide-to="2"></li>
				</ol>
				<div class="carousel-inner">
					<div class="item active">
					<img src="../public/assets/img/teacher.jpg" class="img-responsive" alt="First slide">
						<div class="carousel-caption">		
							<p class="description-carrousel">
								Trouver des professeurs près de chez vous.
							</p>
						</div>
					</div>
					<div class="item">
						<img src="../public/assets/img/matiere.png" class="img-responsive item-slider" alt="Second slide">
						<div class="carousel-caption">											
							<p class="description-carrousel">
								Un large choix de matières.
							</p>
						</div>
					</div>
					<div class="item">
						<img src="../public/assets/img/stripe.png" class="img-responsive item-slider" alt="Third slide">
						<div class="carousel-caption">
							<p class="description-carrousel">
								Un paiement sécurisé.									
							</p>
						</div>
					</div>
				</div>
				<a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left"></span></a><a class="right carousel-control"
					href="#carousel-example-generic" data-slide="next"><span class="glyphicon glyphicon-chevron-right">
				</span></a>
			</div>
		</div>
	</div>

	<div class="presentation">
		<h1 class="title-about">A propos de nous</h1>
		
			<h2 class="home-subtitle">Nos cours particuliers à domicile, la puissance du sur-mesure</h2>

			<p>
			À chaque élève, un enseignant qui lui est entièrement dédié et qui l’accompagne dans sa progression. 
			Voilà résumée dans cette formule toute l’efficacité de nos cours particuliers.

			Chez <strong>Oh ce cours</strong>, l’enseignant ne se contente pas de transmettre un savoir ou d’inculquer une méthode de travail.
			Il s’attache à créer un climat de confiance qui va inciter l’élève à donner le meilleur de lui-même.

			Il l’accompagne dans sa progression et adapte le travail effectué en cours en prenant en compte ses atouts comme ses points faibles.
			Il l’encourage à chaque progrès réalisé et l’empêche de baisser les bras en cas de contre-performance.
			Il varie les exercices et le rythme des séances, afin d’éviter à la routine de s’installer.
			Pour toutes ces raisons, les cours particuliers d'<strong>Oh ce cours</strong> ne ressemblent à aucun autre. Ils sont uniques. Comme chacun de nos élèves.

			<h2 class="home-subtitle">Pourquoi des étudiants ?</h2>
			
			<p>
			Nous avons pu voir auprès de nos nombreux élèves, qu'il était plus simple d'être accompagné par un étudiant prof, pourquoi ? Tout simplement sur le constat suivant :

			Qui de mieux qu'un ancien lycéen pour aider un lycéen ? 

			Les étudiants ont été confrontés aux mêmes problématiques que les élèves, ils auront une pédagogie adaptée pour aider à pallier les lacunes.

			De plus nous avons une réelle volonté d'offrir aux étudiants une alternative aux "jobs étudiants" traditionnels en leur proposant un réel job valorisant. De nombreux étudiants ont la volonté de transmettre leur savoir, nous leur offrons la possibilité d'être rémunérés en proposant ce savoir. Nous espérons réveiller des vocations d'enseignants parmi nos étudiants profs ! 

			Le cours particulier présente de nombreux avantages pour les étudiants, la rémunération est très attractive en comparaison aux autres "jobs étudiants". Cette activité permet aux étudiants de gérer en autonomie leur planning et leur disponibilité et ainsi pas de problématiques pour les études en parallèle !
			</p>

			<h2 class="home-subtitle">Côté pratique…</h2>

			Organisme agréé de services à la personne, <strong>Oh ce cours</strong> vous accompagne en mode mandataire ou en mode prestataire pour vous faire bénéficier d'un service de qualité à prix attractif.
			</p>

	</div>

		<?php if (isset($_SESSION['user'])): ?>
		<?php if ($_SESSION['user']['is_student'] == 1): ?>
		<div class="search-form text-center">
   			<a href="<?= $this->url('search_page', ['id'=> $_SESSION['user']['id']]); ?>"><button type="submit" id="btn-search" class="btn btn-custom btn-large">
   			<span class="fa fa-search"></span>
   			Rechercher votre professeur</button></a>
		</div>

		<?php endif; ?>
		<?php endif; ?>

	<div class="row random-profil">
		<div class="col-md-3 col-xs-6">
			<img class="thumbnail img-responsive center-block avatar-home" src="../public/assets/img/avatar-standard.png">
			<h4 class="text-center"><?= $profs['prof1']['firstname'].' '.$profs['prof1']['lastname']?></h4>
			<p class="text-center"><?= $profs['prof1']['description'] ?><p>
		</div>
		<div class="col-md-3 col-xs-6">
			<img class="thumbnail img-responsive center-block avatar-home" src="../public/assets/img/avatar-standard.png">
			<h4 class="text-center"><?= $profs['prof2']['firstname'].' '.$profs['prof2']['lastname']?></h4>
			<p class="text-center"><?= $profs['prof2']['description'] ?><p>
		</div>
		<div class="col-md-3 col-xs-6">
			<img class="thumbnail img-responsive center-block avatar-home" src="../public/assets/img/avatar-standard.png">
			<h4 class="text-center"><?= $profs['prof3']['firstname'].' '.$profs['prof3']['lastname']?></h4>
			<p class="text-center"><?= $profs['prof3']['description'] ?><p>
		</div>
		<div class="col-md-3 col-xs-6">
			<img class="thumbnail img-responsive center-block avatar-home" src="../public/assets/img/avatar-standard.png">
			<h4 class="text-center"><?= $profs['prof4']['firstname'].' '.$profs['prof4']['lastname']?></h4>
			<p class="text-center"><?= $profs['prof4']['description'] ?><p>
		</div>
	</div>
<?php $this->stop('main_content') ?>