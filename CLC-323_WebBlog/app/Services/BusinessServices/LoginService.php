<?php
namespace App\Services\BusinessServices;
/* passes data to the login dao and makes sure that the proper user is found */

use mysqli;
use App\Services\DataService\LoginDAO;

//securityService class recieves the sent data from Logincontroller and calls the appropriate method in DAO to access the database
class LoginService{
    private $servername;
    private $username;
    private $password;
    private $dbname;
    
    public function __construct(){
    }
    //The user's username and password are used to authenicate if the use is found in the database and returns true if a match was found
    public function authenticate($username, $password){
        //Set up connection
    	$conn = new mysqli("localhost", "root", "root", "323_webblog");
        //check for user
        $security = new LoginDAO($conn);
        $user= $security->findUser($username,$password);
        if($user != null && $user->getUsername() == $username && $user->getPassword() == $password){
            return "true";
        }
        else{
            return "false";
        }
    }
  
}