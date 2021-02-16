@extends('layouts.appmaster')

@section('head','Add Blog')

@section('title')
@section('content')

    <div class = "container-fluid">
    <div class = "row justify-content-center">
    <div class = "col-4">  
	<form action="addBlog" method="post">
	    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
	    
	    <div class="form-group">
			<label for="username"><b>Username:</b></label>
	    	<input type="text" class="form-control" placeholder="Enter your username" name="username" >
	    </div>
	    <div class="form-group">
	    	<label for="blogTitle"><b>Blog Title:</b></label>
	    	<input type="text" class="form-control" placeholder="Enter blog title" name="blogTitle" >
	    </div>
	    <div class="form-group">
	    	<label for="blogContent"><b>Blog Content:</b></label>
	    	<textarea class="form-control" placeholder="Enter blog content you want to save" name="blogContent"></textarea>
	    </div>
	
	    <hr>
	    <button type="submit" class="btn btn-primary">Submit</button>
	</form>
  </div>
  </div>
  </div>
  
  <div class="container signin">
    <p>Want to check read blog posts instead? <a href="BlogSearch">Find blogs here</a>.</p>
  </div>
@endsection