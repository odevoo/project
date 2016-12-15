<?php

namespace Controller;

use \W\Controller\Controller;
use \W\Security\AuthentificationModel;
use \Model\StudentModel;
use \Model\TeacherModel;
//use \W\Model\ConnectionModel;

class AdminController extends Controller
{

    /**
     * Page d'accueil par défaut
     */
    public function showRegisterForm()
    {
        $this->show('admin/register');
    }
    public function processRegisterForm() {

        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        //debug($password);
        if ($_POST['type'] === 'student') {
            $student = new StudentModel ($_POST['firstname'], $_POST['lastname'], $password, $_POST['email'], $_POST['streetNumber'], $_POST['address'], $_POST['city'], $_POST['zip'], $_POST['lat'], $_POST['lng']);
            $emailExist = $student->emailExists($_POST['email']);
            debug($student);
            if ($emailExist === false) {
                $student->insert(['firstname' => $student->getFirstname(), 'lastname' => $student->getLastname(), 'streetnumber' => $student->getStreetNumber(), 'address' => $student->getAddress(), 'city' => $student->getCity(), 'postcode' => $student->getPostalCode(), 'lng' => $student->getLng(), 'lat' => $student->getLat(), 'email' => $student->getEmail(), 'password' => $student->getPassword(), 'is_student' => 1, 'is_teacher' => 0]);
                //echo "Utilisateur enregistré";
            } else {
                $_SESSION['flash']['danger'] = 'Cet email est déjà utilisé';
                $this->showRegisterForm();
            }

        } else {
            $temp = explode(".", $_FILES["file"]["name"]);
            $newfilename = $_POST['lastname'] . '.' . end($temp);
            $teacher = new TeacherModel ($_POST['firstname'], $_POST['lastname'], $password, $_POST['email'], $_POST['address'], $_POST['rating'], $_POST['streetNumber'], $_POST['city'], $_POST['zip'], $_POST['lat'], $_POST['lng'], $_POST['desc'], 'upload/'.$newfilename);
            debug($teacher);
            $emailExist = $teacher->emailExists($_POST['email']);
            debug($emailExist);
            if ($emailExist === false) {
                move_uploaded_file($_FILES["file"]["tmp_name"], "../public/assets/upload/" . $newfilename);
                $teacher->insert(['firstname' => $teacher->getFirstname(), 'lastname' => $teacher->getLastname(), 'streetnumber' => $teacher->getStreetNumber(), 'address' => $teacher->getAddress(), 'city' => $teacher->getCity(), 'postcode' => $teacher->getPostalCode(), 'lng' => $teacher->getLng(), 'lat' => $teacher->getLat(), 'email' => $teacher->getEmail(), 'password' => $teacher->getPassword(), 'is_student' => 0, 'is_teacher' => 1, 'rating' => $teacher->getHourlyRate(), 'description' => $teacher->getDescription(), 'avatar' => $teacher->getAvatar()]);
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
      debug($_POST);
      $login = new AuthentificationModel;
      $user = $login->isValidLoginInfo($_POST['email'], $_POST['password']);
      debug($user);
      if ($user) {
        $isTeacher = new TeacherModel;
        $isTeacher->isTeacher($user);
        debug($isTeacher);
      }
    }

}
