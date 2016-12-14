<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\StudentModel;

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
        

    }

}