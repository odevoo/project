<?php

namespace Controller;

use PHPMailer;
use \W\Controller\Controller;
use \Model\TeacherModel;

class DefaultController extends Controller
{

	/**
	 * Page d'accueil par défaut
	 */
	public function home()
	{
		$profs = $this->searchRandomTeacher();
		$this->show('default/home', ['profs' => $profs]);
	}

	public function searchRandomTeacher()
	{
		$int1 = rand(0, 8);
		$int2 = rand(0, 8);
		$int3 = rand(0, 8);
		$int4 = rand(0, 8);

		$prof = new TeacherModel;

		$profsdata = $prof->findAllTeachers();

		/* test variable prof*/

		/* debug($profsdata[1]); */

		$profs =['prof1' => $profsdata[$int1], 'prof2' => $profsdata[$int2], 'prof3' => $profsdata[$int3], 'prof4' => $profsdata[$int4]];
		return $profs;
	}

	public function showContact()
	{
		$this->show('default/contact');
	}

	public function traitementContact()
	{
		$mail = new PHPMailer();

		$mail->isSMTP(); // on va se connecter directement au serveur SMTP
		$mail->isHTML(true); // on va utiliser le format HTML pour le message
		$mail->Host = "smtp.gmail.com"; // le serveur SMTP utilisé
		$mail->Port = 465; //le port utilisé pour le SMTP
		$mail->SMTPAuth = true; // on va donner des infos au serveur (login/mdp)
		$mail->SMTPSecure = 'ssl'; //certificat SSL
		$mail->Username = "bioforce3@gmail.com"; // utilisateur pour le SMTP
		$mail->Password= "Azerty1234"; // mot de passe pour le SMTP
		$mail->setFrom('bioforce3@gmail.com', 'BioForce 3'); // l'expediteur
		$mail->addAddress('bioforce3@gmail.com'); // le destinataire
			
		$mail->Subject = 'message du formulaire de contact'; // le sujet du mail
		$mail->Body = "<html>
						<head>
						<style>
						h1{color: blue;}
						</style>
						</head>
						<body>
						<h1>Message de ".$_POST['prenom'].' '.$_POST['nom']."</h1>
						<h2>Email: ".$_POST['email']."</h2>
						".$_POST['message']."
						</body>
						</html>"; // le contenu du mail en HTML

		if(!$mail->send()) // si l'envoi délire...
		{
			$_SESSION['flash']['danger'] = 'Il y a eu une erreur lors de l\'envoie';
			$this->show('default/contact');
		}else{
			$_SESSION['flash']['success'] = 'Votre message à bien été envoyé';
			$this->show('default/contact');
		}
	}


}