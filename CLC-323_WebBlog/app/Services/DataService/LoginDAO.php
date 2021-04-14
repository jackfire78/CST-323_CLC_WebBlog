<?php
namespace App\Services\DataService;

use App\Http\Models\User;
use App\Services\Utility\MyLogger;
use Illuminate\Support\Facades\Session;
/**
 * @author Jack Setrak
 * Milestone 5 (4-14-2021)
 * Data service classs to handle all database logic. Takes information passed from Business service and 
 * correctly goes through the proper CRUD methods. Pass, Fail, or Exception get handled in the end.
 * Used to find an existing user. 
 * Contributions: Jack Setrak
 */
class LoginDAO{
    
    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    
    //finds users in database and returns true if found
    public function findUser($username, $password){
    	MyLogger::info('Entering findUser() in LoginDAO');
    	
        //establic connectionto the database(try to put this in the security service)
        if ($this->conn->connect_error){
            echo "Failed to get databse connection!";
        }else{
            //search database credentials for user'
            $sql_statement = "SELECT * FROM `users` WHERE `USERNAME` = '$username' AND `PASSWORD` = '$password' LIMIT 1";
            $result = mysqli_query($this->conn, $sql_statement);
            if ($result) {
                if (mysqli_num_rows($result) == 1) {
                    $row = mysqli_fetch_assoc($result);
                    $user = new User($row['ID'], $row['USERNAME'], $row['PASSWORD'], $row['FIRSTNAME'], $row['LASTNAME'], $row['AGE'], $row['ADDRESS'], $row['EMAIL'], $row['PHONENUM']);
                    Session::put('User',$user);
                    MyLogger::info('Exiting findUser in LoginDAO with successfull login. User now in session');
                    return $user;
                }
            }
        }        
    }

}