<?php
namespace App\Services\DataService;

use App\Http\Models\User;
use App\Services\Utility\MyLogger;
use Illuminate\Support\Facades\Session;

/* Connects to the database to authenticate users */

//securityDAO class that creates or findes user depending on which method is requested from SecurityService
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