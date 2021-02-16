<?php
namespace App\Services\DataService;
use App\Http\Models\User;

//securityDAO class that creates or findes user depending on which method is requested from SecurityService
class RegistrationDAO{
    
    private $conn;
    public function __construct($conn){
        $this->conn = $conn;
    }
    //creates the user in the database
    public function makeUser(User $user){
        //get all variables from user model
        $firstName =$user->getFirstName();
        $lastName = $user->getLastName();
        $username = $user->getUsername();
        $password = $user->getPassword();
        $age = $user->getAge();
        $email = $user->getEmail();
        $address = $user->getAddress();
        $phoneNumber = $user->getPhoneNumber();
        
        //connect to database
        if ($this->conn->connect_error){
            echo "Failed to get databse connection!";
        }else{
            //add user
            $sql_statement_user = "INSERT INTO `users` (`FIRSTNAME`, `LASTNAME`, `USERNAME`,`PASSWORD`,`EMAIL`, `ADDRESS`, `AGE`, `PHONENUM`) VALUES ('$firstName', '$lastName', '$username', '$password', '$email', '$address', '$age', '$phoneNumber')";
            if (mysqli_query($this->conn, $sql_statement_user)) {
                //echo "New user created successfully";
                return true;
            }
        }
    }
    
    //find user by username
    public function findByUsername($username){
        //establish connection to the database
        if ($this->conn->connect_error){
            echo "Failed to get databse connection!";
        }else{
            $sql_statement = "SELECT * FROM `users` WHERE `USERNAME` = '$username' LIMIT 1";
            $result = mysqli_query($this->conn, $sql_statement);
            if ($result) {
                if (mysqli_num_rows($result) == 1) {
                    return true;
                }
            }
            return false;
        }
    } 
}