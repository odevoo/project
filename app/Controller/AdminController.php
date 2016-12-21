<?php

namespace Controller;

use \W\Controller\Controller;
use \W\Security\AuthentificationModel;
use \Model\StudentModel;
use \Model\TeacherModel;
use \Model\LevelModel;
use \Model\LessonsModel;
use \Model\ExpertiseModel;
use \Model\SubjectModel;
use \Controller\SearchController;
use \Controller\AdminController;
use PHPMailer;
use mikehaertl\wkhtmlto\Pdf;
//use \W\Model\ConnectionModel;

class AdminController extends Controller
{

    /**
     * Page d'accueil par défaut
     */
    public function showRegisterForm()
    {
        $level = new LevelModel;
        $leveldata = $level->findAll();
        $search = new SearchController;
        $subjects = $search->getAllSubjects();
        $this->show('admin/register', ['subjects' => $subjects, 'levels' => $leveldata]);
    }
    public function processRegisterForm() {
        //debug($_POST);
        
        $passwordhash = new AuthentificationModel;
        $password = $passwordhash->hashPassword($_POST['password']);
        
        
        if ($_POST['type'] === 'student') {
            $student = new StudentModel ($_POST['firstname'], $_POST['lastname'], $password, $_POST['email'], $_POST['streetNumber'], $_POST['address'], $_POST['city'], $_POST['zip'], $_POST['lat'], $_POST['lng']);
            $emailExist = $student->emailExists($_POST['email']);
            
            if ($emailExist === false) {
                $student->insert(['firstname' => $student->getFirstname(), 'lastname' => $student->getLastname(), 'streetnumber' => $student->getStreetNumber(), 'address' => $student->getAddress(), 'city' => $student->getCity(), 'postcode' => $student->getPostalCode(), 'lng' => $student->getLng(), 'lat' => $student->getLat(), 'email' => $student->getEmail(), 'password' => $student->getPassword(), 'is_student' => 1, 'is_teacher' => 0]);
                
                $_SESSION['flash']['success'] = 'Le compte à été crée';
                $this->showRegisterForm();

            } else {
                $_SESSION['flash']['danger'] = 'Cet email est déjà utilisé';
                $this->showRegisterForm();
            }

        } else {
            $temp = explode(".", $_FILES["file"]["name"]);
            $newfilename = $_POST['lastname'] . '.' . end($temp);
            $teacher = new TeacherModel ($_POST['firstname'], $_POST['lastname'], $password, $_POST['email'], $_POST['address'], $_POST['rating'], $_POST['streetNumber'], $_POST['city'], $_POST['zip'], $_POST['lat'], $_POST['lng'], $_POST['desc'], 'upload/'.$newfilename, $_POST['level'], $_POST['mobility']);
            
            $emailExist = $teacher->emailExists($_POST['email']);
            
            if ($emailExist === false) {
                move_uploaded_file($_FILES["file"]["tmp_name"], "../public/assets/upload/" . $newfilename);

                $teacherdataid = $teacher->insert(['firstname' => $teacher->getFirstname(), 'lastname' => $teacher->getLastname(), 'streetnumber' => $teacher->getStreetNumber(), 'address' => $teacher->getAddress(), 'city' => $teacher->getCity(), 'postcode' => $teacher->getPostalCode(), 'lng' => $teacher->getLng(), 'lat' => $teacher->getLat(), 'email' => $teacher->getEmail(), 'password' => $teacher->getPassword(), 'is_student' => 0, 'is_teacher' => 1, 'price' => $teacher->getHourlyRate(), 'description' => $teacher->getDescription(), 'avatar' => $teacher->getAvatar(), 'id_level' => $teacher->getIdLevel(), 'mobility' => $teacher->getMobility()]);
                 
                
                foreach ($_POST as $key => $value) {
                    if ($value == 'on') {
                        $subject = new ExpertiseModel;
                        $subject->insert(['id_teacher' => $teacherdataid['id'], 'id_subject' => $key]);

                    } 
                }
                $_SESSION['flash']['success'] = 'Le compte à été crée';
                $this->showRegisterForm();

            } else {
                $_SESSION['flash']['danger'] = 'Cet email est déjà utilisé';
                $this->showRegisterForm();
            }
        }

    }

    public function showLoginForm()
    {
      $this->show('admin/login');
    }

    public function processLoginForm() {
      $login = new AuthentificationModel;
      $user = $login->isValidLoginInfo($_POST['email'], $_POST['password']);
      // debug($user);
      if ($user) {
        $isTeacher = new TeacherModel;
        $result = $isTeacher->isTeacher($user);
        //debug($result);
        if ($result['is_teacher'] == 1) {
          $teacher = new TeacherModel;
          $result = $teacher->find($user);
          // debug($result);
          $login->logUserIn($result);
          // debug($_SESSION['user']);
          $_SESSION['flash']['success'] = 'Vous êtes connecté';
          $this->redirectToRoute('default_home');
        }else {
          $student = new StudentModel;
          $result = $student->find($user);
          // debug($result);
          $login->logUserIn($result);

          $_SESSION['flash']['success'] = 'Vous êtes connecté';
          $this->redirectToRoute('default_home');
          // debug($_SESSION['user']);
        }
      } else{
        $_SESSION['flash']['danger'] = ' Votre login / mot de passe sont invalide';
        $this->redirectToRoute('default_home');
      }
    }
    public function showSettingsPage() {
        $level = new LevelModel;
        $leveldata = $level->findAll();
        $search = new SearchController;
        $subjects = $search->getAllSubjects();
        $this->show('admin/settings', ['subjects' => $subjects, 'levels' => $leveldata]);
    }

    public function updateSettings() {
      echo getType($_POST['password']);
      debug($_FILES);
      debug($_POST);
      debug(strlen($_POST['password']));
      if ($_POST['type'] == 'teacher') {
      $teacherglobal = new TeacherModel;
      $teacherglobal->update(['lastname'=> $_POST['lastname'], 'firstname'=> $_POST['firstname'], 'email'=> $_POST['email'],'price'=> $_POST['price'], 'description'=> $_POST['desc']],$_SESSION['user']['id']);

        if (strlen($_POST['password']) != 0 && strlen($_POST['password-confirm']) != 0) {
          if ($_POST['password'] === $_POST['password-confirm']){
            $passwordhash = new AuthentificationModel;
            $password = $passwordhash->hashPassword($_POST['password']);
            $teacher = new TeacherModel;
            $teacher->update(['password'=> $password], $_SESSION['user']['id']);
          } else {
            $_SESSION['flash']['danger'] = 'Les mots de passe ne correspondent pas';
            $this->redirectToRoute('admin_settings');
          }
        }
        if (!empty($_FILES['file']['name'])){
          $temp = explode(".", $_FILES["file"]["name"]);
          $newfilename = $_POST['lastname'] . '.' . end($temp);
          move_uploaded_file($_FILES["file"]["tmp_name"], "../public/assets/upload/" . $newfilename);
          $teacher = new TeacherModel;
          $teacher->update(['avatar'=> 'upload/'.$newfilename], $_SESSION['user']['id']);
        }
      }else{
      $studentglobal = new StudentModel;
      $studentglobal->update(['lastname'=> $_POST['lastname'], 'firstname'=> $_POST['firstname'], 'email'=> $_POST['email']],$_SESSION['user']['id']);

        if (strlen($_POST['password']) != 0 && strlen($_POST['password-confirm']) != 0) {
          if ($_POST['password'] === $_POST['password-confirm']){
            $passwordhash = new AuthentificationModel;
            $password = $passwordhash->hashPassword($_POST['password']);
            $student = new StudentModel;
            $student->update(['password'=> $password], $_SESSION['user']['id']);
          }
        }
      }
      $refresh = new AuthentificationModel;
      $refresh->refreshUser();
      $_SESSION['flash']['success'] = 'Modifications effectuées avec succès';
      $this->redirectToRoute('default_home');
    }

    public function processlogOut() {
      $log = new AuthentificationModel;
      $log->logUserOut();

      $_SESSION['flash']['success'] = 'Vous êtes déconnecté';
      $this->redirectToRoute('default_home');
      //debug($_SESSION);
    }

    public function sendRegisterEmail() {

    }

    public function showSubjectForm() {
        $subject = new SubjectModel;
        $subjectdata = $subject->findAll();
        $this->show('admin/subjects', ['subjects' => $subjectdata]);
    }

    public function insertSubjectForm() {
        $subject = new SubjectModel($_POST['name'], $_FILES['photoSubjects']['name']);
        $subject->insert(['name' => $subject->getName(), 'img' => 'img/'.$subject->getImg()]);

        if(isset($_FILES['photoSubjects'])) {
          $repertoire = '../public/assets/img/'; // le répertoire ou copier l'image
          $fichier = $_FILES['photoSubjects']['name']; //le nom de l'image
          $tmpName = $_FILES['photoSubjects']['tmp_name']; //le fichier temporaire
          move_uploaded_file($tmpName, $repertoire.$fichier); 
        $_SESSION['flash']['success']='Matière insérée avec succès !';
        $this->redirectToRoute('admin_subject');
        } 
    }  

    public function deleteSubjectForm() {
      $subject = new SubjectModel();
      $expertise = new ExpertiseModel();
      $result = $expertise->findSubjects($_POST['id']);
      if ($result['count(*)'] == 0) {
        $subject->delete($_POST['id']);
        $_SESSION['flash']['success']='Matière supprimée avec succès !';
        $this->redirectToRoute('admin_subject');
      } else {
        $_SESSION['flash']['danger']='Cette matière ne peut pas être supprimée car utilisée par des professeurs !';
        $this->redirectToRoute('admin_subject');
      }
    }

    public function generatePdf() {
      debug($_POST);
      //$pdf = new Pdf('../../docs/index.html');
      //$newcontent = file_get_contents('C:\xampp\htdocs\project\docs\test.html');
      $lesson = new LessonsModel;
      $lessons = $lesson->getLessonsByStatutTeacher($_SESSION['user']['id'], 4);
      $i = 1;
      $array = [];
      foreach ($lessons as $lesson) {
        $array[$i] = $lesson['firstname'].'&nbsp'.$lesson['lastname'].'&nbsp'.date("d-m-Y", strtotime($lesson['date'])).'&nbsp'.$lesson['hstart'].':00';
        $i++;
      }


      $newcontent = '<div id="invoiceholder">

  <div id="headerimage"></div>
  <div id="invoice" class="effect2">
    
    <div id="invoice-top">
      <div class="logo"></div>
      <div class="info">
        <h2>Michael Truong</h2>
        <p> hello@michaeltruong.ca </br>
            289-335-6503
        </p>
      </div><!--End Info-->
      <div class="title">
        <h1>Invoice #1069</h1>
        <p>Issued: May 27, 2015</br>
           Payment Due: June 27, 2015
        </p>
      </div><!--End Title-->
    </div><!--End InvoiceTop-->


    
    <div id="invoice-mid">
      
      <div class="clientlogo"></div>
      <div class="info">
        <h2>Client Name</h2>
        <p>JohnDoe@gmail.com</br>
           555-555-5555</br>
      </div>

      <div id="project">
        <h2>Project Description</h2>
        <p>Proin cursus, dui non tincidunt elementum, tortor ex feugiat enim, at elementum enim quam vel purus. Curabitur semper malesuada urna ut suscipit.</p>
      </div>   

    </div><!--End Invoice Mid-->
    
    <div id="invoice-bot">
      
      <div id="table">
        <table>
          <tr class="tabletitle">
            <td class="item"><h2>Item Description</h2></td>
            <td class="Hours"><h2>Hours</h2></td>
            <td class="Rate"><h2>Rate</h2></td>
            <td class="subtotal"><h2>Sub-total</h2></td>
          </tr>
          
          <tr class="service">
            <td class="tableitem"><p class="itemtext">Communication</p></td>
            <td class="tableitem"><p class="itemtext">5</p></td>
            <td class="tableitem"><p class="itemtext">$75</p></td>
            <td class="tableitem"><p class="itemtext">$375.00</p></td>
          </tr>
          
          <tr class="service">
            <td class="tableitem"><p class="itemtext">Asset Gathering</p></td>
            <td class="tableitem"><p class="itemtext">3</p></td>
            <td class="tableitem"><p class="itemtext">$75</p></td>
            <td class="tableitem"><p class="itemtext">$225.00</p></td>
          </tr>
          
          <tr class="service">
            <td class="tableitem"><p class="itemtext">Design Development</p></td>
            <td class="tableitem"><p class="itemtext">5</p></td>
            <td class="tableitem"><p class="itemtext">$75</p></td>
            <td class="tableitem"><p class="itemtext">$375.00</p></td>
          </tr>
          
          <tr class="service">
            <td class="tableitem"><p class="itemtext">Animation</p></td>
            <td class="tableitem"><p class="itemtext">20</p></td>
            <td class="tableitem"><p class="itemtext">$75</p></td>
            <td class="tableitem"><p class="itemtext">$1,500.00</p></td>
          </tr>
          
          <tr class="service">
            <td class="tableitem"><p class="itemtext">Animation Revisions</p></td>
            <td class="tableitem"><p class="itemtext">10</p></td>
            <td class="tableitem"><p class="itemtext">$75</p></td>
            <td class="tableitem"><p class="itemtext">$750.00</p></td>
          </tr>
          
          <tr class="service">
            <td class="tableitem"><p class="itemtext"></p></td>
            <td class="tableitem"><p class="itemtext">HST</p></td>
            <td class="tableitem"><p class="itemtext">13%</p></td>
            <td class="tableitem"><p class="itemtext">$419.25</p></td>
          </tr>
          
            
          <tr class="tabletitle">
            <td></td>
            <td></td>
            <td class="Rate"><h2>Total</h2></td>
            <td class="payment"><h2>$3,644.25</h2></td>
          </tr>
          
        </table>
      </div><!--End Table-->
      
    <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
      <input type="hidden" name="cmd" value="_s-xclick">
      <input type="hidden" name="hosted_button_id" value="QRZ7QTM9XRPJ6">
      <input type="image" src="http://michaeltruong.ca/images/paypal.png" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
    </form>

      
      <div id="legalcopy">
        <p class="legal"><strong>Thank you for your business!</strong>  Payment is expected within 31 days; please process this invoice within that time. There will be a 5% interest charge per month on late invoices. 
        </p>
      </div>
      
    </div><!--End InvoiceBot-->
  </div><!--End Invoice-->
</div><!-- End Invoice Holder-->';

      if (!file_exists('C:\xampp\htdocs\project\docs\newfile.html')) { 
        $handle = fopen('C:\xampp\htdocs\project\docs\newfile.html','w+'); 
        fwrite($handle,$newcontent); 
        fclose($handle); }


        exec('C:\wkhtmltopdf\bin\wkhtmltopdf.exe C:\xampp\htdocs\project\docs\newfile.html form1.pdf');
       
        header('Pragma: public');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Content-Type: application/pdf');
        header('Content-Transfer-Encoding: binary');
        header("Content-Disposition: attachment; filename=report.pdf");
        //header('Content-Length: '.filesize($this->_fileName));
       
        readfile('C:\xampp\htdocs\project\public\form1.pdf');
        /*
      $pdf = new Pdf(array(
        'no-outline',  
        'encoding' => 'UTF-8',       
        'margin-top'    => 0,
        'margin-right'  => 0,
        'margin-bottom' => 0,
        'margin-left'   => 0,

        // Default page options
        'disable-smart-shrinking',
        //'user-style-sheet' => 'C:\xampp\htdocs\project\docs\test.css',
        'user-style-sheet' => 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css',
      ));
      $pdf->binary = 'C:\wkhtmltopdf\bin\wkhtmltopdf.exe';
      $pdf->addPage('C:\xampp\htdocs\project\docs\newfile.html');
      //$pdf->addPage('http://google.com');
      if (!$pdf->send('report.pdf')) {
        echo $pdf->getError();
        }*/
    }

    public function uploadRib() {
      //debug($_FILES);
      //debug($_SESSION);
      $temp = explode(".", $_FILES["files"]["name"][1]);
      $newfilename = $_SESSION['user']['lastname'] . '.' . end($temp);
      move_uploaded_file($_FILES["files"]["tmp_name"][1], "../public/assets/upload/rib/" . $newfilename);
      $teacher = new TeacherModel;
      $teacher->update(['rib' => 'upload/rib/'.$newfilename], $_SESSION['user']['id']);
      $refresh = new AuthentificationModel;
      $refresh->refreshUser();
      $_SESSION['flash']['success'] = 'Votre RIB a été enregistré avec succès';
      $data = 'ok';
      $this->showJson($data);

    }
    public function deleteRib() {
      $teacher = new TeacherModel;
      $teacher->update(['rib' => '' ], $_SESSION['user']['id']);
      $refresh = new AuthentificationModel;
      $refresh->refreshUser();
      $_SESSION['flash']['success'] = "votre rib a été supprimé avec succès";
      $this->redirectToRoute('admin_settings');
    }
}
