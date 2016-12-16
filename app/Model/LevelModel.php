<?php /* app/Model/LevelModel.php */
namespace Model;

use \W\Model\ConnectionModel;

class LevelModel extends \W\Model\Model
{
    private $name;

    public function __construct($name ='') {
        $app = getApp();
        $this->setName($name);
        $this->setTable('levels');
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

    public function findTeacherLevel($id) {
      $sql = 'SELECT level
              FROM levels l
              INNER JOIN users u
              ON l.id = u.id_level
              WHERE
              u.id = :id';
      $stmt = $this->dbh->prepare($sql);
      $stmt->execute(array(':id' => $id));
      $level = $stmt->fetch();
      return $level;
    }
}
