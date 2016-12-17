<?php /* app/Controller/SearchController.php */

namespace Controller;

use \Model\SubjectModel;
use \Model\LessonsModel;
use Stripe;

class LessonsController extends \W\Controller\Controller
{
  

    //Gestion du formulaire de reservation de cours
    public function lessonsReservationForm() {
        //debug($_POST);

        $hstart = intval(substr($_POST['hstart'], -5, 2));
        $hend = intval(substr($_POST['hend'], -5, 2));
        $lesson = new LessonsModel($_POST['id_student'], $_POST['id_teacher'], $_POST['date'], $hstart, $hend, $_POST['subject'], 'aux choix', 1);
        $lesson->insert(['id_student' =>  $lesson->getIdStudent(), 'id_teacher' => $lesson->getIdTeacher(), 'date' => $lesson->getDate(), 'hstart' => $lesson->getHstart(), 'hend' => $lesson->getHend(), 'id_subjects' => $lesson->getIdDiscipline(), 'mobile' => $lesson->getMobile(), 'statut' => $lesson->getStatut()]);
        $_SESSION['flash']['success'] = 'Votre cours à été reservé et est en attente de validation par le professeur';
        $this->showLessonsPage($_POST['id_student']);
     }
     public function showLessonsPage($id) {
        if ($_SESSION['user']['is_student'] == 1) {
            /*Staut 1*/
            $statut1 = new LessonsModel;
            $lessons1 = $statut1->getLessonsByStatutStudent($_SESSION['user']['id'], 1);
            /* Statut 2 */
            $statut2 = new LessonsModel;
            $lessons2 = $statut2->getLessonsByStatutStudent($_SESSION['user']['id'], 2);
            
            /* Statut 3 */
            $statut3 = new LessonsModel;
            $lessons3 = $statut3->getLessonsByStatutStudent($_SESSION['user']['id'], 3);

            /* Statut 4 */
            $statut4 = new LessonsModel;
            $lessons4 = $statut4->getLessonsByStatutStudent($_SESSION['user']['id'], 4);


            /* STRIPE */

            $stripe = array(
                "secret_key"      => "sk_test_pIvyLJj12FdWzjmFUFGVRO1j",
                "publishable_key" => "pk_test_AWlxEJKmNbiDlWgE7BEVWAky"
            );

            \Stripe\Stripe::setApiKey($stripe['secret_key']);

            //Stripe::setApiKey($stripe['secret_key']);

            $this->show('lessons/student', ['lessons1' => $lessons1, 'lessons2' => $lessons2, 'lessons3' => $lessons3, 'lessons4' => $lessons4, 'stripe' => $stripe]);
        } else {
            /*Staut 1*/
            $statut1 = new LessonsModel;
            $lessons1 = $statut1->getLessonsByStatutTeacher($_SESSION['user']['id'], 1);
            /* Statut 2 */
            $statut2 = new LessonsModel;
            $lessons2 = $statut2->getLessonsByStatutTeacher($_SESSION['user']['id'], 2);
            
            /* Statut 3 */
            $statut3 = new LessonsModel;
            $lessons3 = $statut3->getLessonsByStatutTeacher($_SESSION['user']['id'], 3);

            /* Statut 4 */
            $statut4 = new LessonsModel;
            $lessons4 = $statut4->getLessonsByStatutTeacher($_SESSION['user']['id'], 4);


            $this->show('lessons/teacher', ['lessons1' => $lessons1, 'lessons2' => $lessons2, 'lessons3' => $lessons3, 'lessons4' => $lessons4]);
        }
     }

     public function charge() {
        $token  = $_POST['stripeToken'];
        //debug($_POST);


        $stripe = array(
                "secret_key"      => "sk_test_pIvyLJj12FdWzjmFUFGVRO1j",
                "publishable_key" => "pk_test_AWlxEJKmNbiDlWgE7BEVWAky"
            );

        \Stripe\Stripe::setApiKey($stripe['secret_key']);


        $customer = \Stripe\Customer::create(array(
            //'email' => 'customer@example.com',
            'email' => $_POST['stripeEmail'],
            'source'  => $token
        ));
        // $customer->keys();
        $charge = \Stripe\Charge::create(array(
            'customer' => $customer->id,
            'amount'   => $_POST['amout'],
            'currency' => 'eur'
        ));

        $_SESSION['flash']['success'] = 'Paiment accepté';
        $this->showLessonsPage($_POST['id_student']);

        

     }
    

    
}