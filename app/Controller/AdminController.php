<?php

namespace Controller;

use \W\Controller\Controller;
use \W\Security\AuthentificationModel;
use \Model\StudentModel;
use \Model\TeacherModel;
use \Model\LevelModel;
use \Model\ExpertiseModel;
use \Model\SubjectModel;
use \Controller\SearchController;
use \Controller\AdminController;
use PHPMailer;
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
          $this->showLoginForm();
        }else {
          $student = new StudentModel;
          $result = $student->find($user);
          // debug($result);
          $login->logUserIn($result);

          $_SESSION['flash']['success'] = 'Vous êtes connecté';
          $this->showLoginForm();
          // debug($_SESSION['user']);
        }
      }
    }
    public function showSettingsPage() {
        $this->show('admin/settings');
    }

    public function processlogOut() {
      $log = new AuthentificationModel;
      $log->logUserOut();

      $_SESSION['flash']['success'] = 'Vous êtes déconnecté';
      $this->showLoginForm();
      //debug($_SESSION);
    }

    public function sendRegisterEmail() {

    }

    public function showSubjectForm() {
        $subject = new SubjectModel;
        $subjectdata = $subject->findAll($orderBy = 'name');
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


    public function updateSubjectForm() {
    debug($_POST);
    debug($_FILES);
//      debug($_POST['id']);
//      debug($_POST['name']);
    $subject = new SubjectModel($_POST['name']);
    $toto = $subject->getName();
    debug($toto);
    $subject->update(['name' => $subject->getName()], $_POST['id']);
    if (!empty($_FILES['photoSubjects']['name'])) {
      $subject = new SubjectModel($_POST['name'], $_FILES['photoSubjects']['name']);
      $subject->update(['img' => 'img/'.$subject->getImg()], $_POST['id']); 
      $repertoire = '../public/assets/img/'; // le répertoire ou copier l'image
      $fichier = $_FILES['photoSubjects']['name']; //le nom de l'image
      $tmpName = $_FILES['photoSubjects']['tmp_name']; //le fichier temporaire
      debug($fichier);
      debug($tmpName);
      move_uploaded_file($tmpName, $repertoire.$fichier); 
   }
      $_SESSION['flash']['success']='Matière modifiée avec succès !';
      $this->redirectToRoute('admin_subject');
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


}
