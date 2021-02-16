<!-- View page that shows the registeration page when signing up for an account -->
@extends('layouts.appmaster')
@section('head','Sign Up')
@section('title')
	@isset($error)
	  <div class="alert alert-warning">
	   	<strong>Warning!</strong> This user is a duplicate. Please try again with another username.
	  </div>	
	@endisset
	   <h1>Register</h1>
	   <p>Please fill in this form to create an account.</p>
@endsection

@section('content') 
      <div class="register-dark">
        <form action="register" method="post">
          <input type="hidden" name="_token" value="{{csrf_token()}}"/>
            <h2 class="sr-only">Register Form</h2>
            <div class="illustration"><i class="icon ion-ios-compose"></i></div> 
                      
	            <div class="form-group"><input class="form-control" name="firstName" placeholder="Enter Firstname"></div>
	            {{$errors->first('firstname')}} 
	             
	            <div class="form-group"><input class="form-control" name="lastName" placeholder="Enter Lastname"></div>
	            {{$errors->first('lastname')}}
	            
	            <div class="form-group"><input class="form-control" name="username" placeholder="Enter Username"></div>
	            {{$errors->first('username')}}
	            
	            <div class="form-group"><input class="form-control" type="password" name="password" placeholder="Enter Password"></div>
	            {{$errors->first('password')}}
	            
	            <div class="form-group"><input class="form-control" name="age" placeholder="Enter Age"></div>
	            {{$errors->first('age')}}
	            
	            <div class="form-group"><input class="form-control" type="email" name="email" placeholder="Enter Email"></div>
	            {{$errors->first('email')}}
	            
	            <div class="form-group"><input class="form-control" name="address" placeholder="Enter Address"></div>
	            {{$errors->first('address')}}
	            
	            <div class="form-group"><input class="form-control" name="phoneNumber" placeholder="Enter Phone #"></div>
	            {{$errors->first('phoneNumber')}}
	            
            <div class="form-group"><button class="btn btn-primary btn-block" type="submit">Register</button></div>
            <a class="forgot" href="Login">Have an account? Login here</a>
        </form>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
@endsection