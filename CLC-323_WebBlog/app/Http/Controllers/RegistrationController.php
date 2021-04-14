<?php
namespace App\Http\Controllers;

use App\Http\Models\User;
use App\Services\BusinessServices\RegistrationService;
use App\Services\Utility\MyLogger;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Exception;
/**
 * @author Jack Setrak
 * Milestone 5 (4-14-2021)
 * Controller that deals with all Registeration related methods. Handles all form requests and validation before
 * sending information down to Business service.
 * Contributions: Jack Setrak
 */
class RegistrationController extends Controller{
    /**
     * Function that will create user with the form data they filled out
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function createUser(Request $request){
    	MyLogger::info('Entering createUser() in RegistrationController');
    	
        try{
	        //Validate Form Data
	        $this->validateForm($request);
	        //pull form data to make user
	        $firstName = $request->input('firstName');
	        $lastName = $request->input('lastName');
	        $username = $request->input('username');
	        $password = $request->input('password');
	        $age = $request->input('age');
	        $email = $request->input('email');
	        $address = $request->input('address');
	        $phoneNumber = $request->input('phoneNumber');
	        //create new user object
	        $newUser = new User(null, $username, $password, $firstName, $lastName, $age, $address, $email, $phoneNumber);
	        //pass the person object to the registeration service
	        $makeUser = new RegistrationService();
	        //result will return the output of create method within the registeration service
	        $result = $makeUser->create($newUser);
	        
	        if($result){
	        	MyLogger::info('Exiting createUser() in RegistrationController with success');     	
	            //if result is true then take user to the register success view
	            return view('registerSuccess');
	        }
	        //if duplicate user was found then return user to register page with error 
	        elseif ($result == "duplicate"){
	        	MyLogger::info('Exiting createUser() in RegistrationController with duplicate user');
	            return view('showRegister')->with("error","Error");
	        }else{
	        	MyLogger::info('Exiting createUser() in RegistrationController with failure');
	        	//otherwise take user to register failur incase the register process failed to proceed
	        	return view('registerFailure')->with("result",$result);
	        }   
        }catch(ValidationException $e1){
        	MyLogger::info('Exiting createUser() in RegistrationController with validation exception');    	
            throw $e1;
        }
        catch(Exception $e2){
        	MyLogger::info('Exiting createUser() in RegistrationController exception');       	
            //return view("systemException");
        }
    }
    
    /**
     * Function that will vaildate form data to confirm the user inputed useable information
     * @param Request $request
     */
    private function validateForm(Request $request){
        // Setup Data Validation Rules for Register Form
        $rules = ['firstName' => 'Required | Between:1,24',
            'lastName' => 'Required | Between:1,24',
            'username' => 'Required | Between:1,24',
            'email' => 'Required | Between:1,30 | email',
            'age' => 'Required | Between:1,3 | numeric',
            'password' => 'Required | Between:1,24',
            'address' => 'Required | Between:10,80',
            'phoneNumber' => 'Required | Between:10,10',];
        
        // Run Data Validation Rules
        $this->validate($request, $rules);
    }
}
