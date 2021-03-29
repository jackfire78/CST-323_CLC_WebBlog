<?php
namespace App\Services\BusinessServices;

use App\Http\Models\User;
use App\Services\DataService\RegistrationDAO;
use App\Services\Utility\MyLogger;
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
    	MyLogger::info('Entering create() in RegistrationService');
    	
    	// local testing database
    	$conn = new mysqli("localhost", "root", "root", "323_webblog");
        // Database Connection
    	// $conn = new mysqli ( "lyn7gfxo996yjjco.cbetxkdyhwsb.us-east-1.rds.amazonaws.com", "u8f7vzzvkj9sn2oc", "ve7sgjbc7cj8mxvc", "f7dacmyrfygsdhw0" );
    	
    	//make new user in database using user model
        $security = new RegistrationDAO($conn);
        $result = $security->findByUsername($user->getUsername());
        //check if it is duplicate
        if($result == "true"){
        	MyLogger::info('Exiting create() in RegistrationService with duplicate user');      	
            //return duplicate to controller if true
            return "duplicate";
        }
        else{
            //if no duplicate found make the user
            $result = $security->makeUser($user);
            //relay if successfull to the controller
            if($result=="true"){
            	MyLogger::info('Exiting create() in RegistrationService with true');
                return "true";
            }else{
            	MyLogger::info('Exiting create() in RegistrationService with false');
            	return "false";
            }
        }
    }    
    
}