<?php /* app/Model/StudentModel.php */
namespace Model;

class StudentModel extends \W\Model\Model 
{
    private $firstname;
    private $lastname;
    private $password;
    private $email;
    private $address;

    public function __construct($firstname ='', $lastname = '', $password = '', $email ='', $address = '') {
        
        $this->setFirstname($firstname);
        $this->setLastname($lastname);
        $this->setPassword($password);
        $this->setEmail($email);
        $this->setAddress($address);


    }

    public function setFirstname($firstname) {
        $this->firstname = $firstname;
    }
    public function setLastname($lastname) {
        $this->lastname = $lastname;
    }
    public function setPassword($password) {
        $this->password = $password;
    }
    public function setEmail($email) {
        $this->email = $email;
    }
    public function setAddress($address) {
        $this->address = $address;
    }

    public function getFirstname() {
        return $this->firstname;
    }
    public function getLastname() {
        return $this->lastname;    
    }
    public function getPassword() {
        return $this->password;    
    }
    public function getEmail() {
        return $this->email; 
    }
    public function getAddress() {
        return $this->address;   
    }

 
}