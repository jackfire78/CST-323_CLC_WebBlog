<?php 
namespace App\Http\Models;

/* Module provides the base model of the user instance */

//user model class outlines all user data
class User {    
    private $userId = null;
    private $username;
    private $password;
    private $firstName;
    private $lastName;
    private $age;
    private $address;
    private $email;
    private $phoneNumber;
    
    public function getId(){
        return $this->userId;
    }
    public function getFirstName(){
        return $this->firstName;
    }   
    public function getLastName(){
        return $this->lastName;
    }    
    public function getUsername(){
        return $this->username;
    }    
    public function getPassword(){
        return $this->password;
    }
    public function getAge(){
        return $this->age;
    }
    public function getAddress(){
        return $this->address;
    }
    public function getEmail(){
        return $this->email;
    }
    public function getPhoneNumber(){
        return $this->phoneNumber;
    }
    
    public function toString(){
        return " User Id: ". $this->userId." | Username: ". $this->username." | Password: ". $this->password." | firstName: ". $this->firstName." | lastName: ". $this->lastName." | age: ". $this->age." | address: ". $this->address." | email: ". $this->email." | phonenumber: ". $this->phoneNumber;
    }
    //constructor method 
    public function __construct($id,$uname,$pswd,$fname,$lname,$age,$address,$email,$phoneNum){
        $this->userId = $id;
        $this->username = $uname;
        $this->password= $pswd;
        $this->firstName = $fname;
        $this->lastName = $lname;
        $this->age = $age;
        $this->address = $address;
        $this->email = $email;
        $this->phoneNumber = $phoneNum;
    }
    
}
?>