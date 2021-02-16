<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use Exception;
use App\Services\BusinessServices\LoginService;

//controller hold basic methods to either route to other views or request securityservice for further user specific actions
class LoginController extends Controller{
    public function __construct(){
    }
    
    //Function to authenicate that a user can use this account to login into the site 
    public function authenticate(Request $request){
        try{
	        //Validate Form Data
	        $this->validateForm($request);
	        // get form data
	        $username = $request->input('username');
	        $password = $request->input('password');
	        // create security service
	        $isUser = new LoginService();
	        // send username and password to service
	        $result = $isUser->authenticate($username, $password);
	        // check if user was found
	        if ($result) {
	            return view('loginSuccess');
	        } else {
	            //if no user is found then return the user to login failed view with result
	            return view('loginFailure')->with("result", $result);
	       }   
        }
        catch(ValidationException $e1){
            throw $e1;
        }
        catch(Exception $e2){
            //return view("systemException");
        }
    }
    
    //Clears the session so the user logs out
    public function logoutUser(){
        Session::flush();
        return view('showLogout');
    }
    
    //Function that will vaildate form data to confirm the user inputed useable information
    private function validateForm(Request $request){
        // Setup Data Validation Rules for Login Form
        $rules = ['username' => 'Required | Between:1,24 ',
            'password' => 'Required | Between:1,24'];
        
        // Run Data Validation Rules
        $this->validate($request, $rules);
    }
}
