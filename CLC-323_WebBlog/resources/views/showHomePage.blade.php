@extends('layouts.appmaster')
@section('head','Home')
@section('title','Home Page')

@section('content')
<br/>
    @if (!Session::has('User'))    
    <p>Welcome to web blogs. Head over to register to make a new account or <br/>
   	if you already have one, head over to login instead. </p>
   	@else
   	<p>Home page. Please navigate to either 'Submit Blog' or 'Search Blogs' pages. </p>
    @endif
@endsection