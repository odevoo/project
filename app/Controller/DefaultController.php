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
		$subject = 'message du formulaire de contact';
		$recipient = 'bioforce3@gmail.com';
		$title = 'Message de '.$_POST['prenom'].' '.$_POST['nom'].'';
		$content = '<h2>Email: '.$_POST['email'].'</h2>
		'.$_POST['message'].'';
		$this->sendMail($recipient, $subject,$title,$content);

	/*	$mail = new PHPMailer();

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
		}*/
	}




	public function sendMail($recipient, $subject,$title,$content)
	{
		$mail = new PHPMailer();

		$mail->isSMTP(); // on va se connecter directement au serveur SMTP
		$mail->isHTML(true); // on va utiliser le format HTML pour le message
		$mail->Host = "smtp.gmail.com"; // le serveur SMTP utilisé
		$mail->Port = 465; //le port utilisé pour le SMTP
		$mail->SMTPAuth = true; // on va donner des infos au serveur (login/mdp)
		$mail->SMTPSecure = 'ssl'; //certificat SSL
		$mail->Username = "bioforce3@gmail.com"; // utilisateur pour le SMTP
		$mail->Password= "547896321"; // mot de passe pour le SMTP
		$mail->setFrom('bioforce3@gmail.com', 'Oh Ce Cours'); // l'expediteur
		$mail->addAddress($recipient); // le destinataire

		$mail->Subject = $subject; // le sujet du mail
		$mail->Body = '<html>
				<head>
					<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
					<meta name="viewport" content="width=device-width, initial-scale=1.0">
					<meta property="og:title" content="Issue 17 - Thirteen Pro-Tips for Email Design">
					<!--[if !mso]><!-->
					<meta http-equiv="X-UA-Compatible" content="IE=edge">
					<!--<![endif]-->
					<meta name="robots" content="noindex, nofollow">
					<title>MailChimp ♥ Agencies</title>
					<link rel="stylesheet" type="text/css" href="https://gallery.mailchimp.com/cc11276e0af3cd3f833d3e2d1/files/inlined_styles.01.css">

					<link href="https://fonts.googleapis.com/css?family=Merriweather:300,400,700" rel="stylesheet">
					<!--[if (gte mso 9)|(IE)]>
						<style type="text/css">
							.body-content, .serif, .quote {font-family: Georgia, serif !important;line-height: 35px !important;}
							h1, h2, h3 {font-family: Arial, Helvetica, sans-serif !important;}
							.pixel-graphic {width: 910px !important; height: 160px !important;}
						</style>
					<![endif]-->
					<style type="text/css">
						body,.hide-tweet-block,* [lang~=hide-tweet-block]{
												background-color:rgba(255,255,255,1);
										}
										.quote-wrap:hover .quote,* [lang~=quote-wrap]:hover * [lang~=quote]{
												color:rgba(109, 197, 220, 1)!important;
										}
										.quote-wrap:hover .hide-tweet-block,* [lang~=quote-wrap]:hover * [lang~=hide-tweet-block]{
												background-color:rgba(255,255,255,0)!important;
										}
										.tweet-block:hover,* [lang~=tweet-block]:hover{
												background-color:#53b6f3!important;
										}
										.read-more:hover a,* [lang~=read-more]:hover{
												color:#6DC5DC!important;
												text-decoration:none!important;
										}
										.read-more:hover a .continue-arrow,* [lang~=read-more]:hover * [lang~=continue-arrow]{
												width:30px!important;
												text-decoration:none!important;
										}
										.cta-outer:hover .cta-inner,* [lang~=cta-outer]:hover * [lang~=cta-inner]{
												background-color:rgba(255,255,255,0.2)!important;
										}
										.cta-outer:hover a,* [lang~=cta-outer]:hover a{
												color:#FFFFFF!important;
												text-decoration:none!important;
										}
										a{
												color:#6DC5DC;
										}
										a:hover{
												text-decoration:underline!important;
										}
										.ExternalClass *{
												line-height:100%;
										}
										a[x-apple-data-detectors]{
												color:inherit !important;
												text-decoration:none !important;
												font-size:inherit !important;
												font-family:inherit !important;
												font-weight:inherit !important;
												line-height:inherit !important;
										}
										.primary-color{
												background-color:#557d38;
										}
										.secondary-color{
												background-color:#8f97a5;
										}
										.body-content,.serif{
												color:#373737;
												font-family:"Merriweather", Georgia, serif;
												font-size:21px;
												line-height:1.6;
												letter-spacing:0.1px;
												font-weight:300;
												text-align:left;
										}
										.cta-outer{
												border-radius:4px;
										}
										.cta-inner,.cta-inner a{
												color:#FFFFFF;
												text-decoration:none;
										}
										.cta-inner{
												font-family:"Helvetica Neue", Helvetica, Arial, sans-serif;
												font-size:21px;
												font-weight:400;
												line-height:1;
												padding-top:15px;
												padding-right:30px;
												padding-bottom:15px;
												padding-left:30px;
										}
										#header-background{
												background-image:url("https://gallery.mailchimp.com/cc11276e0af3cd3f833d3e2d1/images/eb03c0d3-84e0-44f0-b693-d69d14e87c88.jpg");
												padding-top:450px;
												background-position:top;
												background-size:cover;
										}
										h1,span.h1{
												font-family:"Helvetica Neue", Helvetica, Arial, sans-serif;
												font-size:62px;
												font-weight:bold;
												line-height:1.2;
												letter-spacing:0;
												margin:0;
										}
										h2,span.h2{
												font-family:"Helvetica Neue", Helvetica, Arial, sans-serif;
												font-size:42px;
												font-weight:bold;
												line-height:1.2;
												letter-spacing:0;
												margin:0;
										}
										h3,span.h3{
												font-family:"Helvetica Neue", Helvetica, Arial, sans-serif;
												font-size:24px;
												font-weight:bold;
												line-height:1.2;
												letter-spacing:0;
												margin:0;
										}
										.quote{
												font-family:"Merriweather", Georgia, serif;
												font-weight:500;
												font-size:24px;
												line-height:1.5;
												font-style:italic;
												color:#000000;
												letter-spacing:0.1px;
										}
										.footer-color{
												color:#eeeeee;
										}
								@media screen and (max-width: 768px){
										.wrap{
												min-width:0!important;
										}

						}   @media screen and (max-width: 768px){
										#header-background{
												padding-top:35%!important;
										}

						}   @media screen and (max-width: 768px){
										.left-sidebar,.right-sidebar,.left-sidebar-freddie,.right-tweet-sidebar{
												width:85px!important;
												min-width:85px!important;
												max-width:85px!important;
										}

						}   @media screen and (max-width: 768px){
										.freddie{
												width:50%!important;
												margin:0 auto;
										}

						}   @media screen and (max-width: 768px){
										.hide-tweet-block{
												background-color:transparent!important;
										}

						}   @media screen and (max-width: 768px){
										.tweet-block{
												background-color:#1da1f2!important;
										}

						}   @media screen and (max-width: 720px){
										.full-width{
												width:100%!important;
										}

						}   @media screen and (max-width: 568px){
										.cta-inner,.follow-up-text{
												font-size:18px!important;
										}

						}   @media screen and (max-width: 568px){
										.up-next-container{
												padding:20px 15px!important;
										}

						}   @media screen and (max-width: 568px){
										#header-background,#footer-background{
												overflow:hidden!important;
										}

						}   @media screen and (max-width: 568px){
										#header-background img,#footer-background img{
												width:148%!important;
										}

						}   @media screen and (max-width: 568px){
										.left-sidebar,.right-sidebar,.desktop{
												display:none!important;
										}

						}   @media screen and (max-width: 568px){
										.freddie{
												width:50px!important;
												margin:0 auto!important;
												padding-right:20px!important;
												padding-left:15px!important;
										}

						}   @media screen and (max-width: 568px){
										.body-content{
												padding-left:15px!important;
												padding-right:15px!important;
												font-size:16px!important;
										}

						}   @media screen and (max-width: 568px){
										.serif,.mc-loves-agencies{
												font-size:16px!important;
										}

						}   @media screen and (max-width: 568px){
										.header-issue{
												font-size:12px!important;
										}

						}   @media screen and (max-width: 568px){
										h1,span.h1{
												font-size:42px!important;
										}

						}   @media screen and (max-width: 568px){
										h2,span.h2{
												font-size:30px!important;
										}

						}   @media screen and (max-width: 568px){
										h3,span.h3,.quote{
												font-size:18px!important;
										}

						}   @media screen and (max-width: 568px){
										.hr-container,.quote-wrap,.posts-container,.blog-post{
												padding-top:30px!important;
												padding-bottom:30px!important;
										}

						}   @media screen and (max-width: 568px){
										.blog-post{
												padding-left:15px!important;
												padding-right:15px!important;
										}

						}   @media screen and (max-width: 568px){
										.cta-outer{
												width:90%!important;
												margin:0 auto!important;
												text-align:center!important;
												box-sizing:border-box!important;
										}

						}   @media screen and (max-width: 568px){
										ul,ol{
												margin:0;
												padding-left:15px!important;
										}

						}   @media screen and (max-width: 568px){
										li{
												padding-bottom:20px!important;
												padding-left:10px!important;
										}

						}   @media screen and (max-width: 568px){
										li ul,li ol,li ul li ul,li ol li ol{
												padding-top:15px!important;
												padding-left:15px!important;
										}

						}   @media screen and (max-width: 568px){
										li ul li,li ol li{
												padding-bottom:10px!important;
												padding-left:10px!important;
										}

						}   @media screen and (max-width: 568px){
										li ul li ul li,li ol li ol li{
												padding-bottom:10px!important;
										}

						}   @media screen and (max-width: 568px){
										.quote-pad{
												padding-left:25px!important;
												padding-right:25px!important;
												width:100%!important;
												box-sizing:border-box;
												display:block;
										}

						}   @media screen and (max-width: 568px){
										.right-tweet-sidebar{
												width:100%!important;
												min-width:100%!important;
												max-width:100%!important;
												display:block;
												padding-top:10px!important;
										}

						}   @media screen and (max-width: 568px){
										.tweet-block-table{
												margin:0 auto!important;
										}

						}   @media screen and (max-width: 568px){
										.tweet-block{
												opacity:1!important;
												background-image:url("https://gallery.mailchimp.com/cc11276e0af3cd3f833d3e2d1/images/9604dbc0-5291-4585-8c39-75894ace3af2.png");
												background-repeat:no-repeat;
												background-position:center;
												background-size:100% 100%;
												width:30px!important;
												height:35px!important;
										}

						}   @media screen and (max-width: 568px){
										.tweet-block a{
												width:30px!important;
												height:35px!important;
												display:block!important;
										}

						}   @media screen and (max-width: 568px){
										.caption{
												font-size:12px!important;
										}

						}   @media screen and (max-width: 568px){
										.image-wrap{
												padding-top:30px!important;
												padding-bottom:20px!important;
										}

						}   @media screen and (max-width: 568px){
										.up-next-content{
												padding-top:20px!important;
										}

						}   @media screen and (max-width: 568px){
										.post-container{
												width:100%!important;
												min-width:0!important;
										}

						}   @media screen and (max-width: 568px){
										.legal-info{
												padding-left:15px!important;
												padding-right:15px!important;
												padding-bottom:30px!important;
										}

						}
					</style>
				</head>

				<body style="padding: 0;margin: 0;font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: rgba(255,255,255,1);">

					<!--[if (gte mso 9)|(IE)]><table border="0" cellpadding="0" cellspacing="0" width="910" align="center" style="table-layout: fixed;" align="center"><tr><td align="center"><![endif] -->
					<table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;mso-table-lspace: 0;mso-table-rspace: 0;margin: 0;">
						<tbody>
							<tr>
								<td align="center" bgcolor="#ffffff" style="background-color: #ffffff;border-collapse: collapse;mso-table-lspace: 0;mso-table-rspace: 0;margin: 0;">

									<!-- Email Wrapper -->
									<table border="0" cellpadding="0" cellspacing="0" width="100%" class="wrap" style="min-width: 700px;max-width: 1200px;border-collapse: collapse;mso-table-lspace: 0;mso-table-rspace: 0;margin: 0;" align="center">
										<tbody>
											<tr>
												<td align="center" style="border-collapse: collapse;mso-table-lspace: 0;mso-table-rspace: 0;margin: 0;">
													<!-- Header -->
													<table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;mso-table-lspace: 0;mso-table-rspace: 0;margin: 0;">
														<tbody>
															<tr>
																<td valign="bottom" align="center" id="header-background" class="primary-color" style="background:url("https://gallery.mailchimp.com/cc11276e0af3cd3f833d3e2d1/images/eb03c0d3-84e0-44f0-b693-d69d14e87c88.jpg") top/cover;border-collapse: collapse;mso-table-lspace: 0;mso-table-rspace: 0;margin: 0;background-color: #557d38;background-image: url(https://gallery.mailchimp.com/cc11276e0af3cd3f833d3e2d1/images/eb03c0d3-84e0-44f0-b693-d69d14e87c88.jpg);padding-top: 450px;background-position: top;background-size: cover;">
																	<img class="wrap pixel-graphic" src="https://gallery.mailchimp.com/cc11276e0af3cd3f833d3e2d1/images/433d4d25-7b4c-4c27-9577-96fe1e79cb4e.png" width="910" border="0" style="min-width:700px;display:block;width:100%;">
																</td>
															</tr>
														</tbody>
													</table>
													<!-- End Header -->

													<!-- Content Container -->
													<table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 910px;border-collapse: collapse;mso-table-lspace: 0;mso-table-rspace: 0;margin: 0;">
														<tbody>
															<tr>
																<td align="center" style="padding-top: 40px;border-collapse: collapse;mso-table-lspace: 0;mso-table-rspace: 0;margin: 0;">

																	<!-- Mailchimp For Agencies -->
																	<table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;mso-table-lspace: 0;mso-table-rspace: 0;margin: 0;">
																		<tbody>
																			<tr>

																				<td align="left" valign="middle" width="700" style="padding-bottom: 30px;border-collapse: collapse;mso-table-lspace: 0;mso-table-rspace: 0;margin: 0;">
																					<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;mso-table-lspace: 0;mso-table-rspace: 0;margin: 0;">
																						<tbody>
																							<tr>
																								<td class="mc-loves-agencies" style="font-family: Helvetica Neue, Helvetica, Arial, sans-serif;font-size: 21px;line-height: 1;font-weight: 600;color: #373737;border-collapse: collapse;mso-table-lspace: 0;mso-table-rspace: 0;margin: 0;">Oh Ce Cours <span style="color:#E85C41; font-family:helvetica">♥</span></td>
																							</tr>
																							<tr>
																								<td class="header-issue" style="font-family: Helvetica Neue, Helvetica, Arial, sans-serif;font-size: 16px;line-height: 1;font-weight: 600;color: #B7B7B7;padding-top: 4px;border-collapse: collapse;mso-table-lspace: 0;mso-table-rspace: 0;margin: 0;">Cours Particuliers</td>
																							</tr>
																						</tbody>
																					</table>
																				</td>
																				<td class="right-sidebar" align="left" valign="middle" width="105" style="padding-bottom: 30px;border-collapse: collapse;mso-table-lspace: 0;mso-table-rspace: 0;margin: 0;"></td>
																			</tr>
																		</tbody>
																	</table>
																	<!-- End Mailchimp For Agencies -->

																	<!-- Content Modules -->

																	<!-- Text Area No Pixels -->
																	<table mc:repeatable="repeat_1" mc:variant="Text Area No Pixels" border="0" cellpadding="0" cellspacing="0" width="100%" mc:repeatindex="0" style="border-collapse: collapse;mso-table-lspace: 0;mso-table-rspace: 0;margin: 0;">
																		<tbody>
																			<tr>
																				<td class="left-sidebar" align="left" valign="middle" width="105" style="border-collapse: collapse;mso-table-lspace: 0;mso-table-rspace: 0;margin: 0;">
																				</td>
																				<td align="left" valign="middle" width="700" class="body-content" style="border-collapse: collapse;mso-table-lspace: 0;mso-table-rspace: 0;margin: 0;color: #373737;font-family: "Merriweather", Georgia, serif;font-size: 21px;line-height: 1.6;letter-spacing: 0.1px;font-weight: 300;text-align: left;">
																					<h1 class="null" style="font-family: Helvetica Neue, Helvetica, Arial, sans-serif;font-size: 62px;font-weight: bold;line-height: 1.2;letter-spacing: 0;margin: 0;">'.$title.'</h1>
																				</td>
																				<td class="right-sidebar" align="left" valign="bottom" width="105" style="border-collapse: collapse;mso-table-lspace: 0;mso-table-rspace: 0;margin: 0;">
																				</td>
																			</tr>
																		</tbody>
																	</table>
																	<table mc:repeatable="repeat_1" mc:variant="Text Area No Pixels" border="0" cellpadding="0" cellspacing="0" width="100%" mc:repeatindex="1" style="border-collapse: collapse;mso-table-lspace: 0;mso-table-rspace: 0;margin: 0;">
																		<tbody>
																			<tr>
																				<td class="left-sidebar" align="left" valign="middle" width="105" style="border-collapse: collapse;mso-table-lspace: 0;mso-table-rspace: 0;margin: 0;">
																				</td>
																				<td align="left" valign="middle" width="700" class="body-content" style="border-collapse: collapse;mso-table-lspace: 0;mso-table-rspace: 0;margin: 0;color: #373737;font-family: Merriweather, Georgia, serif;font-size: 21px;line-height: 1.6;letter-spacing: 0.1px;font-weight: 300;text-align: left;">
																					<p dir="ltr"><br>
																						'.$content.'
																					</p>
																				</td>
																				<td class="right-sidebar" align="left" valign="bottom" width="105" style="border-collapse: collapse;mso-table-lspace: 0;mso-table-rspace: 0;margin: 0;">
																				</td>
																			</tr>
																		</tbody>
																	</table>




														</tbody>
													</table>
													<!-- Footer Graphic -->
													<table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;mso-table-lspace: 0;mso-table-rspace: 0;margin: 0;">
														<tbody>
															<tr>
																<td id="footer-background" valign="top" align="center" class="secondary-color" style="padding-bottom: 30px;box-sizing: border-box;border-collapse: collapse;mso-table-lspace: 0;mso-table-rspace: 0;margin: 0;background-color: #8f97a5;">
																	<img class="wrap pixel-graphic" src="https://gallery.mailchimp.com/cc11276e0af3cd3f833d3e2d1/images/1ef1106d-c1a2-4c3c-b986-a7b27344dc82.png" width="910" border="0" style="min-width:700px;width:100%;display: block;">
																</td>
															</tr>
															<tr>
																<td class="legal-info secondary-color" lang="legal-info" align="center" style="padding: 30px;border-collapse: collapse;mso-table-lspace: 0;mso-table-rspace: 0;margin: 0;background-color: #8f97a5;">
																	<!-- Legal -->
																	<table class="full-width" border="0" cellpadding="0" cellspacing="0" width="700" align="center" style="border-collapse: collapse;mso-table-lspace: 0;mso-table-rspace: 0;margin: 0;">
																		<tbody>
																			<tr>
																				<td align="left" class="footer-color" style="font-size: 14px;font-family: Helvetica Neue, Helvetica, Arial, sans-serif;text-decoration: none;line-height: 1;font-weight: 400;border-collapse: collapse;mso-table-lspace: 0;mso-table-rspace: 0;margin: 0;color: #eeeeee;">
																					© 2016 OhCeCours® , All Rights Reserved.
																				</td>
																			</tr>

																		</tbody>
																	</table>
																	<!-- End Legal -->
																</td>
															</tr>
														</tbody>
													</table>
													<!-- End Footer Graphic -->
													<!-- End Footer -->
												</td>
											</tr>
										</tbody>
									</table>

									<!--[if (gte mso 9)|(IE)]></td></tr></table><![endif] -->

								</td>
							</tr>
						</tbody>
					</table>
					<!-- Gmail Spacer -->
					<div style="display:none; white-space:nowrap; font:15px courier; line-height:0;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
						&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</div>
					</body>
						</html>'; // le contenu du mail en HTML

		if(!$mail->send()) // si l'envoi délire...
		{
			$_SESSION['flash']['danger'] = $mail->ErrorInfo;
		}else{
			$_SESSION['flash']['success'] = 'Votre message à bien été envoyé';
		}
	}


}
