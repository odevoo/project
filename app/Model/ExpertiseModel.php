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
 
}