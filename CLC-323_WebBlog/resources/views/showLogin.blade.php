<!-- View page that shows the login page when a user attempts to sign into their account -->
@extends('layouts.appmaster')
@section('head','Login')

@section('title')
@isset($error)
  <div class="alert alert-warning">
  	<strong>Warning!</strong> Error with user session, Please log in again.
  </div>	
@endisset
    <h2>Login</h2>
@endsection

@section('content')
<!-- action will point to the route -->   
    <div class="login-dark">
        <form action="login" method="post">
          <input type="hidden" name="_token" value="{{csrf_token()}}"/>
            <h2 class="sr-only">Login Form</h2>
            <div class="illustration"><i class="icon ion-ios-locked-outline"></i></div>
            <div class="form-group"><input class="form-control" name="username" placeholder="Enter Username"></div>
            {{$errors->first('username')}}            
            <div class="form-group"><input class="form-control" type="password" name="password" placeholder="Enter Password"></div>
            {{$errors->first('password')}}
            <div class="form-group"><button class="btn btn-primary btn-block" type="submit">Log In</button></div>
            <a class="forgot" href="Register">Don't have an account? Register here</a>
        </form>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
@endsection