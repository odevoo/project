<?php /* app/Model/LessonsModel.php */
namespace Model;

use \W\Model\ConnectionModel;

class LessonsModel extends \W\Model\Model 
{
    private $id_student;
    private $id_teacher;
    private $date;
    private $hstart;
    private $hend;
    private $id_discipline;
    private $mobile;
    private $token;
    private $comment;
    private $statut;

    public function __construct($id_student = 0, $id_teacher = 0, $date = '', $hstart = 0, $hend = 0, $id_discipline = '', $mobile = '', $statut = '', $token = '', $comment = '' ) {
        $app = getApp();
        $this->setIdStudent($id_student);
        $this->setIdTeacher($id_teacher);
        $this->setDate($date);
        $this->setHstart($hstart);
        $this->setHend($hend);
        $this->setIdDiscipline($id_discipline);
        $this->setMobile($mobile);
        $this->setToken($token);
        $this->setComment($comment);
        $this->setStatut($statut);
        $this->setTable('lessons');
        $this->dbh = ConnectionModel::getDbh();


    }
    /* SETTEUR */
    public function setIdStudent($id_student) {
        $this->id_student = $id_student;
    }
    public function setIdTeacher($id_teacher) {
        $this->id_teacher = $id_teacher;
    }
    public function setDate($date) {
        $this->date = $date;
    }
    public function setHstart($hstart) {
        $this->hstart = $hstart;
    }
    public function setHend($hend) {
        $this->hend = $hend;
    }
    public function setIdDiscipline($id_discipline) {
        $this->id_discipline = $id_discipline;
    }
    public function setMobile($mobile) {
        $this->mobile = $mobile;
    }
    public function setToken($token) {
        $this->token = $token;
    }
    public function setComment($comment) {
        $this->comment = $comment;
    }
        public function setStatut($statut) {
        $this->statut = $statut;
    }


    /* GETTEUR */

    public function getIdStudent() {
        return $this->id_student;
    }
    public function getIdTeacher() {
        return $this->id_teacher;    
    }
    public function getDate() {
        return $this->date;    
    }
    public function getHstart() {
        return $this->hstart; 
    }
    public function getHend() {
        return $this->hend;
    }
    public function getIdDiscipline() {
        return $this->id_discipline;   
    }
    public function getMobile() {
        return $this->mobile;
    }
    public function getToken() {
        return $this->token;
    }
    public function getComment() {
        return $this->comment;
    }
     public function getStatut() {
        return $this->statut;
    }
}