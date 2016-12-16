<?php /* app/Model/SubjectsModel.php */
namespace Model;

use \W\Model\ConnectionModel;

class SubjectModel extends \W\Model\Model
{
    private $name;


    public function __construct($name ='') {
        $app = getApp();
        $this->setName($name);
        $this->setTable('subjects');
        $this->dbh = ConnectionModel::getDbh();


    }
    /* SETTEUR */
    public function setName($name) {
        $this->name = $name;
    }
    /* GETTEUR */

    public function getName() {
        return $this->name;
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
