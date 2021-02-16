<?php
namespace App\Services\BusinessServices;

use App\Http\Models\User;
use App\Services\DataService\RegistrationDAO;
use mysqli;
/* Business Service rules for registrations, connects to Registration DAO */
class RegistrationService{
    //Method to add a new user
    private $servername;
    private $username;
    private $password;
    private $dbname;
    
    public function __construct(){
    }
    //create method takes user data inputed in registeration page and send information over to the DAO to add the user profile into the Database
    public function create(User $user){
        //Database Connection
    	$conn = new mysqli("localhost", "root", "root", "323_webblog");
    	//make new user in database using user model
        $security = new RegistrationDAO($conn);
        $result = $security->findByUsername($user->getUsername());
        //check if it is duplicate
        if($result == "true"){
            //return duplicate to controller if true
            return "duplicate";
        }
        else{
            //if no duplicate found make the user
            $result = $security->makeUser($user);
            //relay if successfull to the controller
            if($result=="true")
                return "true";
            return "false";
        }
    }    
    
}