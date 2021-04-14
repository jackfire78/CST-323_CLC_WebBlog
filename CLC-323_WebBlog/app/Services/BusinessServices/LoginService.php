<?php
namespace App\Services\BusinessServices;
/* passes data to the login dao and makes sure that the proper user is found */

use mysqli;
use App\Services\DataService\LoginDAO;
use App\Services\Utility\MyLogger;
/**
 * @author Jack Setrak
 * Milestone 5 (4-14-2021)
 * Login service class to handle data sent from controller. Creates connection to database and passes that to a new
 * instance of a DAO
 * Contributions: Jack Setrak
 */
class LoginService{
    private $servername;
    private $username;
    private $password;
    private $dbname;
    
    public function __construct(){
    }
    //The user's username and password are used to authenicate if the use is found in the database and returns true if a match was found
    public function authenticate($username, $password){
    	MyLogger::info('Entering authenticate() in LoginService');
    	
    	//local testing database
    	// $conn = new mysqli("localhost", "root", "root", "323_webblog");
        //Set up Heroku connection
    	$conn = new mysqli ( "lyn7gfxo996yjjco.cbetxkdyhwsb.us-east-1.rds.amazonaws.com", "u8f7vzzvkj9sn2oc", "ve7sgjbc7cj8mxvc", "f7dacmyrfygsdhw0" );
    	
        //check for user
        $security = new LoginDAO($conn);
        $user= $security->findUser($username,$password);
        if($user != null && $user->getUsername() == $username && $user->getPassword() == $password){
        	MyLogger::info('Exiting authenticate() in LoginService with true');
        	
            return "true";
        }
        else{
        	MyLogger::info('Exiting authenticate() in LoginService with false');
            return "false";
        }
    }
  
}