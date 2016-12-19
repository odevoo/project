<?php /* app/Model/SubjectsModel.php */
namespace Model;

use \W\Model\ConnectionModel;

class SubjectModel extends \W\Model\Model
{
    private $name;
    private $img;


    public function __construct($name ='', $img ='') {
        $app = getApp();
        $this->setName($name);
        $this->setImg($img);
        $this->setTable('subjects');
        $this->dbh = ConnectionModel::getDbh();


    }
    /* SETTEUR */
    public function setName($name) {
        $this->name = $name;
    }

    public function setImg($img) {
        $this->img = $img;
    }

    /* GETTEUR */

    public function getName() {
        return $this->name;
    }

    public function getImg() {
        return $this->img;
    }


    public function findTeacherSubjects($id) {
      $sql = 'SELECT s.id , name
              FROM subjects s
              INNER JOIN expertises e
              ON s.id = e.id_subject
              INNER JOIN users u
              ON e.id_teacher = u.id
              WHERE
              u.id = :id';
      $stmt = $this->dbh->prepare($sql);
      $stmt->execute(array(':id' => $id));
      $teachers = $stmt->fetchAll();
      return $teachers;
    }
}
