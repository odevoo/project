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
        $lesson = new LessonsModel;
        $lessons = $lesson->getLessonsByStatutTeacherInfo($_SESSION['user']['id'], 4);

        $total = 0;
        foreach ($lessons as $lesson) {
          $price = ($lesson['hend'] - $lesson['hstart']) * $lesson['price'];
          $totallesson = $price - ( $price * (5/100));
          $total += $totallesson; 
        }


        $level = new LevelModel;
        $leveldata = $level->findAll();
        $search = new SearchController;
        $subjects = $search->getAllSubjects();
        $this->show('admin/settings', ['subjects' => $subjects, 'levels' => $leveldata, 'total' => $total]);
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
      $lessons = $lesson->getLessonsByStatutTeacherInfo($_SESSION['user']['id'], 4);
      $i = 1;
      $array = [];
      foreach ($lessons as $lesson) {
        $array[$i]['date'] = date("d-m-Y", strtotime($lesson['date']));
        $array[$i]['firstname'] = $lesson['firstname'];
        $array[$i]['lastname'] = $lesson['lastname'];
        $array[$i]['email'] = $lesson['email'];
        $array[$i]['hours'] = $lesson['hend'] - $lesson['hstart'];
        $array[$i]['frais'] = ($array[$i]['hours'] * $lesson['price']) * (5/100);
        $array[$i]['total'] = ($array[$i]['hours'] * $lesson['price']) - $array[$i]['frais'];
        $i++;
      }
      $total = $array[1]['total'] + $array[2]['total'] + $array[3]['total'] + $array[4]['total'] + $array[5]['total'];

      $newcontent = ' 
      <style>
            
@import url(http://fonts.googleapis.com/css?family=Roboto:100,300,400,900,700,500,300,100);
*{
  margin: 0;
  box-sizing: border-box;

}
body{
  background: #E0E0E0;
  font-family: "Roboto", sans-serif;
  
  background-repeat: repeat-y;
  background-size: 100%;
}
::selection {background: #f31544; color: #FFF;}
::moz-selection {background: #f31544; color: #FFF;}
h1{
  font-size: 1.5em;
  color: #222;
}
h2{font-size: .9em;}
h3{
  font-size: 1.2em;
  font-weight: 300;
  line-height: 2em;
}
p{
  font-size: .7em;
  color: #666;
  line-height: 1.2em;
}

#invoiceholder{
  width:100%;
  hieght: 100%;
  padding-top: 50px;
}
#headerimage{
  z-index:-1;
  position:relative;
  top: -50px;
  height: 350px;
  background-image: url(http://michaeltruong.ca/images/invoicebg.jpg);

  -webkit-box-shadow:inset 0 2px 4px rgba(0,0,0,.15), inset 0 -2px 4px rgba(0,0,0,.15);
  -moz-box-shadow:inset 0 2px 4px rgba(0,0,0,.15), inset 0 -2px 4px rgba(0,0,0,.15);
  box-shadow:inset 0 2px 4px rgba(0,0,0,.15), inset 0 -2px 4px rgba(0,0,0,.15);
  overflow:hidden;
  background-attachment: fixed;
  background-size: 1920px 80%;
  background-position: 50% -90%;
}
#invoice{
  position: relative;
  top: -290px;
  margin: 0 auto;
  width: 700px;
  background: #FFF;
}

[id*="invoice-"]{ 
  border-bottom: 1px solid #EEE;
  padding: 30px;
}

#invoice-top{min-height: 120px;}
#invoice-mid{min-height: 120px;}
#invoice-bot{ min-height: 250px;}

.logo{
  float: left;
  height: 28px;
  width: 28px;
  background: url(http://localhost/project/public/assets/img/pencil-case.png) no-repeat;
  background-size: 28px 28px;
}
.clientlogo{
  float: left;
  height: 60px;
  width: 60px;
  background: url(http://michaeltruong.ca/images/client.jpg) no-repeat;
  background-size: 60px 60px;
  border-radius: 50px;
}
.info{
  display: block;
  float:left;
  margin-left: 20px;
}
.title{
  float: right;
}
.title p{text-align: right;}
#project{margin-left: 52%;}
table{
  width: 100%;
  border-collapse: collapse;
}
td{
  padding: 5px 0 5px 15px;
  border: 1px solid #EEE
}
.tabletitle{
  padding: 5px;
  background: #EEE;
}
.service{border: 1px solid #EEE;}
.item{width: 50%;}
.itemtext{font-size: .9em;}

#legalcopy{
  margin-top: 30px;
}
form{
  float:right;
  margin-top: 30px;
  text-align: right;
}


.effect2
{
  position: relative;
}
.effect2:before, .effect2:after
{
  z-index: -1;
  position: absolute;
  
  bottom: 15px;
  left: 10px;
  width: 50%;
  top: 80%;
  max-width:300px;
  background: #777;
  -webkit-box-shadow: 0 15px 10px #777;
  -moz-box-shadow: 0 15px 10px #777;
  box-shadow: 0 15px 10px #777;
  -webkit-transform: rotate(-3deg);
  -moz-transform: rotate(-3deg);
  -o-transform: rotate(-3deg);
  -ms-transform: rotate(-3deg);
  transform: rotate(-3deg);
}
.effect2:after
{
  -webkit-transform: rotate(3deg);
  -moz-transform: rotate(3deg);
  -o-transform: rotate(3deg);
  -ms-transform: rotate(3deg);
  transform: rotate(3deg);
  right: 10px;
  left: auto;
}



.legal{
  width:70%;
}

      </style>

      <div id="invoiceholder">

  <div id="headerimage"></div>
  <div id="invoice" class="effect2">
    
    <div id="invoice-top">
      <div class="logo"></div>
      <div class="info">
        <h1>Oh ce cours!</h1>
        
      </div><!--End Info-->
      <div class="title">
        <h1>Recapitulatif d\'activite</h1>
        
      </div><!--End Title-->
    </div><!--End InvoiceTop-->


    
    <div id="invoice-mid">
      
      <!--<div class="clientlogo"></div>-->
      <div class="info">
        <h2>'.$array[1]["firstname"].' '.$array[1]["lastname"].'1111</h2>
        <p>'.$array[1]["email"].'</br>
        </div>

      

    </div><!--End Invoice Mid-->
    
    <div id="invoice-bot">
      
      <div id="table">
        <table>
          <tr class="tabletitle">
            <td class="item"><h2>Date</h2></td>
            <td class="Hours"><h2>Heures</h2></td>
            <td class="Rate"><h2>Frais</h2></td>
            <td class="subtotal"><h2>total</h2></td>
          </tr>
          
          <tr class="service">
            <td class="tableitem"><p class="itemtext">'.$array[1]["date"].'</p></td>
            <td class="tableitem"><p class="itemtext">'.$array[1]["hours"].'</p></td>
            <td class="tableitem"><p class="itemtext">'.$array[1]["frais"].'</p></td>
            <td class="tableitem"><p class="itemtext">'.$array[1]["total"].'</p></td>
          </tr>
          
          <tr class="service">
            <td class="tableitem"><p class="itemtext">'.$array[2]["date"].'</p></td>
            <td class="tableitem"><p class="itemtext">'.$array[2]["hours"].'</p></td>
            <td class="tableitem"><p class="itemtext">'.$array[2]["frais"].'</p></td>
            <td class="tableitem"><p class="itemtext">'.$array[2]["total"].'</p></td>
          </tr>
          
          <tr class="service">
            <td class="tableitem"><p class="itemtext">'.$array[3]["date"].'</p></td>
            <td class="tableitem"><p class="itemtext">'.$array[3]["hours"].'</p></td>
            <td class="tableitem"><p class="itemtext">'.$array[3]["frais"].'</p></td>
            <td class="tableitem"><p class="itemtext">'.$array[3]["total"].'</p></td>
          </tr>
          
          <tr class="service">
            <td class="tableitem"><p class="itemtext">'.$array[4]["date"].'</p></td>
            <td class="tableitem"><p class="itemtext">'.$array[4]["hours"].'</p></td>
            <td class="tableitem"><p class="itemtext">'.$array[4]["frais"].'</p></td>
            <td class="tableitem"><p class="itemtext">'.$array[4]["total"].'</p></td>
          </tr>
          
          <tr class="service">
            <td class="tableitem"><p class="itemtext">'.$array[5]["date"].'</p></td>
            <td class="tableitem"><p class="itemtext">'.$array[5]["hours"].'</p></td>
            <td class="tableitem"><p class="itemtext">'.$array[5]["frais"].'</p></td>
            <td class="tableitem"><p class="itemtext">'.$array[5]["total"].'</p></td>
          </tr>
          
          <tr class="service">
            <td class="tableitem"><p class="itemtext"></p></td>
            <td class="tableitem"><p class="itemtext"></p></td>
            <td class="tableitem"><p class="itemtext"></p></td>
            <td class="tableitem"><p class="itemtext"></p></td>
          </tr>
          
            
          <tr class="tabletitle">
            <td></td>
            <td></td>
            <td class="Rate"><h2>Total</h2></td>
            <td class="payment"><h2>'.$total.' Euros</h2></td>
          </tr>
          
        </table>
      </div>
      
    

      
      <div id="legalcopy">
        
      </div>
      
    </div>
  </div>
</div>
     ';

      if (!file_exists('C:\xampp\htdocs\project\docs\\'.$_SESSION['user']['lastname'].'.html')) { 
        $handle = fopen('C:\xampp\htdocs\project\docs\\'.$_SESSION['user']['lastname'].'.html','w+'); 
        fwrite($handle,$newcontent); 
        fclose($handle); }


        exec('C:\wkhtmltopdf\bin\wkhtmltopdf.exe C:\xampp\htdocs\project\docs\\'.$_SESSION['user']['lastname'].'.html form1.pdf');
       
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
