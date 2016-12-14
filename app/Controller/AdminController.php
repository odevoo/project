<?php

namespace Controller;

use \W\Controller\Controller;
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

        debug($_POST);
        if ($_POST['type'] === 'student') {
            $student = new StudentModel ($_POST['firstname'], $_POST['lastname'], $_POST['password'], $_POST['email'], $_POST['streetNumber'], $_POST['address'], $_POST['city'], $_POST['zip'], $_POST['lat'], $_POST['lng']);
            //debug($student->getFirstname());
            $student->insert(['firstname' => $student->getFirstname(), 'lastname' => $student->getLastname(), 'streetnumber' => $student->getStreetNumber(), 'address' => $student->getAddress(), 'city' => $student->getCity(), 'postcode' => $student->getPostalCode(), 'lng' => $student->getLng(), 'lat' => $student->getLat(), 'email' => $student->getEmail(), 'password' => $student->getPassword()]);
        }
        /*$teacher = new TeacherModel ($_POST['firstname'], $_POST['lastname'], $_POST['password'], $_POST['email'], $_POST['address']);
        debug($teacher);
        $teacher->insert(['firstname' => $teacher->getFirstname(), 'lastname' => $teacher->getLastname()]);*/
        

    }

}
