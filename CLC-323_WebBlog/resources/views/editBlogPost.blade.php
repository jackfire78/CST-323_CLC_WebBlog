@extends('layouts.appmaster')

@section('head','Add Blog')

@section('title')
@section('content')

    <div class = "container-fluid">
    <div class = "row justify-content-center">
    <div class = "col-4">  
	<form action="editPost" method="post">
	    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
	    <input type="hidden" name="id" value="{{$blog->getId()}}" />
	    
	    <div class="form-group">
			<label for="username"><b>Username:</b></label>
	    	<input type="text" class="form-control" value="{{$blog->getUsername()}}" name="username" >
	    </div>
	    <div class="form-group">
	    	<label for="blogTitle"><b>Blog Title:</b></label>
	    	<input type="text" class="form-control" value="{{$blog->getTitle()}}" name="blogTitle" >
	    </div>
	    <div class="form-group">
	    	<label for="blogContent"><b>Blog Content:</b></label>
	    	<input type="text" class="form-control" value="{{$blog->getContent()}}" name="blogContent"></textarea>
	    </div>
	
	    <hr>
	    <button type="submit" class="btn btn-primary">Confirm Edit</button>
	</form>
	@if($errors->count() != 0)
      	<h5 align="center">List of Errors</h5>
	@foreach($errors->all() as $message)
		<p align="center">{{ $message }} </p><br>
	@endforeach
	@endif
  </div>
  </div>
  </div>
  
  <div class="container signin">
    <p>Want to check read blog posts instead? <a href="BlogSearch">Find blogs here</a>.</p>
  </div>
@endsection