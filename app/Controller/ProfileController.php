<?php /* app/Controller/SearchController.php */

namespace Controller;

use \Model\SubjectModel;
use \Model\TeacherModel;
use \Model\LevelModel;
use \Model\LessonsModel;

class ProfileController extends \W\Controller\Controller
{


    //Affiche la page profile
    public function showProfile($id)
    {
        $subjects = new SubjectModel;
        $subjectsData = $subjects->findTeacherSubjects($id);
        $level = new LevelModel;
        $levelData = $level->findTeacherLevel($id);
        $teacher = new TeacherModel;
        $teacherdata = $teacher->find($id);
        $lesson = new LessonsModel;
        $lessonData = $lesson->getLessonsCommentAndRatingByTeacher($id);
        $rating = $lesson->getAverageByTeacher($id);
        $this->show('profile/profile',['teacher' => $teacherdata, 'subjects' => $subjectsData, 'level' => $levelData, 'lessons' => $lessonData ,'rating' => $rating]);
    }


}
