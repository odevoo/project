<?php /* app/Model/LevelModel.php */
namespace Model;

use \W\Model\ConnectionModel;

class LevelModel extends Model 
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
 
}