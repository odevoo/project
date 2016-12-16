<?php /* app/Controller/SearchController.php */

namespace Controller;

use \Model\SubjectModel;
use \Model\TeacherModel;

class ProfileController extends \W\Controller\Controller
{
  

    //Affiche la page profile
    public function showProfile($id)
    {
        $teacher = new TeacherModel;
        $teacherdata = $teacher->find($id);
        $this->show('profile/profile',['teacher' => $teacherdata]);
    }
    
}