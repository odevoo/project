<?php /* app/Model/StudentModel.php */
namespace Model;

use \W\Model\ConnectionModel;

class StudentModel extends \W\Model\UsersModel 
{
    private $firstname;
    private $lastname;
    private $password;
    private $email;
    private $streetNumber;
    private $address;
    private $city;
    private $postalCode;
    private $lat;
    private $lng;

    public function __construct($firstname ='', $lastname = '', $password = '', $email ='',$streetNumber = 0, $address = '', $city = '', $postalCode = '', $lat = 0, $lng = 0) {
        $app = getApp();
        $this->setFirstname($firstname);
        $this->setLastname($lastname);
        $this->setPassword($password);
        $this->setEmail($email);
        $this->setStreetNumber($streetNumber);
        $this->setAddress($address);
        $this->setCity($city);
        $this->setPostalCode($postalCode);
        $this->setLat($lat);
        $this->setLng($lng);
        $this->setTable('students');
        $this->dbh = ConnectionModel::getDbh();


    }
    /* SETTEUR */
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
    public function setStreetNumber($streetNumber) {
        $this->streetNumber = $streetNumber;
    }
    public function setAddress($address) {
        $this->address = $address;
    }
    public function setCity($city) {
        $this->city = $city;
    }
    public function setPostalCode($postalCode) {
        $this->postalCode = $postalCode;
    }
    public function setLat($lat) {
        $this->lat = $lat;
    }
    public function setLng($lng) {
        $this->lng = $lng;
    }


    /* GETTEUR */

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
    public function getStreetNumber() {
        return $this->streetNumber;
    }
    public function getAddress() {
        return $this->address;   
    }
    public function getCity() {
        return $this->city;
    }
    public function getPostalCode() {
        return $this->postalCode;
    }
    public function getLat() {
        return $this->lat;
    }
    public function getLng() {
        return $this->lng;
    }

 
}