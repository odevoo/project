<?php /* app/Controller/SearchController.php */

namespace Controller;

use \Model\SubjectModel;

class SearchController extends \W\Controller\Controller
{
	public function getAllSubjects() {

		$subject = new SubjectModel;
		$subjects = $subject->findAll();
		return $subjects;
	}


	//Affiche la page recherche
	public function searchPage()
	{
		$subjects = $this->getAllSubjects();
//		debug($subjects);
		$this->show('search/home',['subjects' => $subjects]);
	}
}