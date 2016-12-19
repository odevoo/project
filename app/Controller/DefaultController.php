<?php

namespace Controller;

use \W\Controller\Controller;
use \MOdel\TeacherModel;

class DefaultController extends Controller
{

	/**
	 * Page d'accueil par défaut
	 */

	public function home()
	{
		$profs = $this->searchRandomTeacher();
		$this->show('default/home', ['randomprof' => $profs]);
	}

	function searchRandomTeacher()
	{
	
		$int1 = rand_int(1 min, 10 max);
		$int2 = rand_int(1 min, 10 max);
		$int3 = rand_int(1 min, 10 max);
		$int4 = rand_int(1 min, 10 max);	

		$prof1 new TeacherModel;
		$prof2 new TeacherModel;
		$prof3 new TeacherModel;
		$prof4 new TeacherModel;	

		$prof1data = $prof1-> find($int4);
		$prof2data = $prof2-> find($int4);
		$prof3data = $prof3-> find($int4);
		$prof4data = $prof4-> find($int4);

		$profs = ['$prof1' =>$prof1data, '$prof2'=>$prof2data, '$prof3'=>$prof3data, '$prof4'=>$prof4data];
		return $profs;
	}
}