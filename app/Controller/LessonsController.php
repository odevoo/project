<?php /* app/Controller/SearchController.php */

namespace Controller;

use \Model\SubjectModel;
use \Model\LessonsModel;

class LessonsController extends \W\Controller\Controller
{
  

    //Affiche la page profile
    public function lessonsReservationForm() {
        debug($_POST);
        $hstart = intval(substr($_POST['hstart'], -5, 2));
        $hend = intval(substr($_POST['hend'], -5, 2));
        $lesson = new LessonsModel($_POST['id_student'], $_POST['id_teacher'], $_POST['date'], $hstart, $hend, $_POST['subject'], 'aux choix', 1);
        $lesson->insert(['id_student' =>  $lesson->getIdStudent(), 'id_teacher' => $lesson->getIdTeacher(), 'date' => $lesson->getDate(), 'hstart' => $lesson->getHstart(), 'hend' => $lesson->getHend(), 'id_subjects' => $lesson->getIdDiscipline(), 'mobile' => $lesson->getMobile(), 'statut' => $lesson->getStatut()]);

     }
    

    
}