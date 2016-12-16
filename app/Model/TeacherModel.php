<?php /* app/Model/TeacherModel.php */
namespace Model;


use \W\Model\ConnectionModel;

class TeacherModel extends \W\Model\UsersModel
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
    private $description;
    private $idlevel;
    private $mobility;


    public function __construct($firstname ='', $lastname = '', $password = '', $email ='', $address = '', $hourlyRate = 0.00, $streetNum = 0, $city = '', $postalCode = '', $lat = 0, $lng = 0, $description = '', $avatar = 'avatar.png', $idlevel = 1, $mobility = 'à domicile') {

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
        $this->setDescription($description);
        $this->setIdLevel($idlevel);
        $this->setMobility($mobility);
        $this->setTable('users');
        $this->dbh = ConnectionModel::getDbh();
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
    public function setDescription($description) {
        $this->description = $description;
    }
    public function setIdLevel($idlevel){
        $this->idlevel = $idlevel;
    }
    public function setMobility($mobility){
        $this->mobility = $mobility;
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
    public function getStreetNumber() {
        return $this->streetNum;
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
    public function getAvatar() {
        return $this->avatar;
    }
    public function getDescription() {
        return $this->description;
    }
    public function getIdLevel(){
        return $this->idlevel;
    }
    public function getMobility() {
        return $this->mobility;
    }


    public function isTeacher($id)
    {
        $sql = 'SELECT is_teacher FROM users
                WHERE id = :id';
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $isTeacher = $stmt->fetch();
        return $isTeacher;
    }

    public function findAllTeachers() {
        $sql = 'SELECT * FROM users WHERE is_teacher = 1';
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute();
        $teachers = $stmt->fetchAll();
        return $teachers;
    }

}
