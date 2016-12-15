<?php

namespace Controller;

use \W\Controller\Controller;
use \W\Security\AuthentificationModel;
use \Model\StudentModel;
use \Model\TeacherModel;

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

        debug($_POST);
        if ($_POST['type'] === 'student') {
            $student = new StudentModel ($_POST['firstname'], $_POST['lastname'], $_POST['password'], $_POST['email'], $_POST['address']);
            //debug($student->getFirstname());
            $student->insert(['firstname' => $student->getFirstname(), 'lastname' => $student->getLastname()]);
        }
        $teacher = new TeacherModel ($_POST['firstname'], $_POST['lastname'], $_POST['password'], $_POST['email'], $_POST['address']);
        debug($teacher);
        $teacher->insert(['firstname' => $teacher->getFirstname(), 'lastname' => $teacher->getLastname()]);

    }

    public function showLoginForm()
    {
      $this->show('admin/login');
    }

    public function processLoginForm() {
      $login = new AuthentificationModel;
      $user = $login->isValidLoginInfo($_POST['email'], $_POST['password']);
      if ($user) {
        # code...
      }
    }

}
