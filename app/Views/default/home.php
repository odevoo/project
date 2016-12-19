<?php $this->layout('layout', ['title' => 'Accueil']) ?>

<?php $this->start('main_content') ?>

	<?php //debug($profs); ?>
	<div class="main-text">
		<div class="text-center">
			<h1 class="slider-title">
				Nos Prestations Générales
			</h1>							
		</div>
	</div>

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
						<img src="../public/assets/img/photo-slider-1.jpg " class="img-responsive" alt="First slide">
						<div class="carousel-caption">									
							<p>
								Description Photo 1
							</p>
						</div>
					</div>
					<div class="item">
						<img src="http://placehold.it/1200x500/9b59b6/8e44ad" alt="Second slide">
						<div class="carousel-caption">											
							<p>
								Description Photo 2
							</p>
						</div>
					</div>
					<div class="item">
						<img src="http://placehold.it/1200x500/34495e/2c3e50" alt="Third slide">
						<div class="carousel-caption">
							<p>
								Description Photo 3									
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
		<h1>A propos de nous</h1>
		<p>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque iusto, beatae ratione mollitia molestias doloremque at tempore laboriosam omnis esse qui, fuga nihil dignissimos, dolore eius animi, impedit asperiores cumque?Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus aliquid, illo provident iure perspiciatis excepturi officia quasi! Necessitatibus delectus, quasi animi, quibusdam numquam vero earum odio. Rem repellat iusto pariatur.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facilis ipsam laudantium, voluptatibus eveniet numquam ex voluptates harum quis temporibus. Iste esse optio, velit quidem quos alias perspiciatis magni assumenda perferendis.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam dolores dolorum blanditiis maxime iusto, hic, voluptatum corporis harum nostrum, minus nulla incidunt culpa! Dolor provident distinctio debitis maxime pariatur odit.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptas consequatur dignissimos, laboriosam fugit magni, enim, voluptatem voluptate voluptatibus minus nulla ullam, odit a quos ipsam sit. Esse, ipsa. Velit, eveniet!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo sapiente itaque delectus commodi omnis, esse ut ea et deserunt dolorum quisquam officiis nisi voluptate autem a sed totam repellat. In.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque, et ipsa blanditiis tenetur voluptas odio, odit, nisi voluptate aperiam quod incidunt illo praesentium alias tempora fuga temporibus modi est laudantium!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vitae animi sunt asperiores rerum, perspiciatis, est omnis voluptatum cum eius consectetur recusandae a totam cupiditate mollitia voluptas quia! Doloremque, aut magnam.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odio reprehenderit porro quaerat harum quia quod perferendis ipsam, impedit quo nihil rerum non officia eos accusamus ab ad nisi omnis nostrum!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus unde tempora, vero quae id dignissimos aliquam? Pariatur dolor quas veritatis quae voluptatibus voluptatem reprehenderit blanditiis recusandae inventore maiores.
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