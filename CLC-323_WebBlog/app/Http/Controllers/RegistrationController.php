<?php
namespace App\Http\Controllers;

/* Module provides all methods needed to authenticate/ create users, and return views when requested */
use App\Http\Models\User;
use App\Services\BusinessServices\RegistrationService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Exception;
//controller hold basic methods to either route to other views or request securityservice for further user specific actions
class RegistrationController extends Controller{
    /**
     * Function that will create user with the form data they filled out
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function createUser(Request $request){
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
            //if result is true then take user to the register success view
            return view('registerSuccess');
        }
        //if duplicate user was found then return user to register page with error 
        elseif ($result == "duplicate"){
            return view('showRegister')->with("error","Error");
        }
        //otherwise take user to register failur incase the register process failed to proceed
        return view('registerFailure')->with("result",$result);   
        }
        catch(ValidationException $e1){
            throw $e1;
        }
        catch(Exception $e2){
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
