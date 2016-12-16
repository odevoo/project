<?php /* app/Controller/SearchController.php */

namespace Controller;

use \Model\SubjectModel;
use \Model\TeacherModel;
use \Model\StudentModel;

class SearchController extends \W\Controller\Controller
{
	public function getAllSubjects() {

		$subject = new SubjectModel;
		$subjects = $subject->findAll();
		return $subjects;
		// $orderBy = $name
	}



	//Affiche la page recherche
	public function searchPage($id)
	{
		$subjects = $this->getAllSubjects();
		$student = new StudentModel;
		$studentdata = $student->find($id);

//		debug($subjects);
		$this->show('search/home',['subjects' => $subjects, 'student' => $studentdata]);
	}


	//recherche des infos des professeurs à proximité pour Google maps
	
	public function getAllTeachers() {
		$teacher = new TeacherModel;
		$teachers['data'] = $teacher->findAllTeachers();
		return $this->showJson($teachers);
	}

	//recherche latitude longitude du student
	public function getLatLng($id1) {
		$student = new StudentModel;
		$studentdata['data'] = $student->find($id1);
		$result = $this->showJson($studentdata);
		return $result;
	}
	

	public function searchResultPage($id) {
		$this->show('search/result');
	}
	
}