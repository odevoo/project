<?php /* app/Model/SubjectsModel.php */
namespace Model;

use \W\Model\ConnectionModel;

class ExpertiseModel extends \W\Model\Model 
{
    
    

    public function __construct($name ='') {
        $app = getApp();
        
        $this->setTable('expertises');
        $this->dbh = ConnectionModel::getDbh();


    }

    public function findSubjects($id) {
    	$sql = 'SELECT count(*) FROM expertises
                WHERE id_subject = :id';
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute(array(':id' => $id));
        $subject = $stmt->fetch();
        return $subject;
    }
    public function deleteTeacherSubjects($id) {
      $sql = 'DELETE FROM expertises WHERE id_teacher = :id';
      $stmt = $this->dbh->prepare($sql);
      $stmt->execute(array(':id' => $id));
      //$teachers = $stmt->fetchAll();
      return true;
    }
 
}