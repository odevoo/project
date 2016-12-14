<?php /* app/Model/StudentModel.php */
namespace Model;

class TeacherModel extends \W\Model\Model
{
    private $firstname;
    private $lastname;
    private $password;
    private $email;
    private $hourlyRate;
    private $streetNum;
    private $address;
    private $city;
    private $postalCode;
    private $lat;
    private $lng;
    private $avatar;


    public function __construct($firstname ='', $lastname = '', $password = '', $email ='', $address = '', $hourlyRate = 0.00, $streetNum = '', $city = '', $postalCode = '', $lat = 0, $lng = 0, $avatar = 'avatar.png') {

        $this->setFirstname($firstname);
        $this->setLastname($lastname);
        $this->setPassword($password);
        $this->setEmail($email);
        $this->setHourlyRate($hourlyRate);
        $this->setStreetNumber($streetNum);
        $this->setAddress($address);
        $this->setCity($city);
        $this->setPostalCode($postalCode);
        $this->setLat($lat);
        $this->setLng($lng);
        $this->setAvatar($avatar);

    }

    //    Set
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
    public function setHourlyRate($hourlyRate) {
        $this->hourlyRate = $hourlyRate;
    }
    public function setStreetNumber($streetNum) {
        $this->streetNum = $streetNum;
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
    public function setAvatar($avatar) {
        $this->avatar = $avatar;
    }


    //    Get
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
    public function getHourlyRate() {
        return $this->hourlyRate;
    }
    public function getStreetNumber($streetNum) {
        return $this->streetNum = $streetNum;
    }
    public function getAddress($address) {
        return $this->address = $address;
    }
    public function getCity($city) {
        return $this->city = $city;
    }
    public function getPostalCode($postalCode) {
        return $this->postalCode = $postalCode;
    }
    public function getLat($lat) {
        return $this->lat = $lat;
    }
    public function getLng($lng) {
        return $this->lng = $lng;
    }
    public function getAvatar($avatar) {
        $this->avatar = $avatar;
    }


}
