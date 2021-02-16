@extends('layouts.appmaster')
@section('head','Search Blogs')
@section('title', 'Search Results')
@section('content')

<!-- Blog Postings -->
<div class = "container">   
    <div class= "row justify-content-center">
    	<div class = "col">
    	<form method="post" action="searchBlogs">
	        <input type="hidden" name="_token" value="{{csrf_token()}}" />
	    	<input type="text" name="username" placeholder = "Search by username"> 
	        <button class="btn btn-dark" type="submit">Search</button>       			
        </form>
        
    	<table class="table table-dark">
    	<tr>
    	  <th scope="col">Id</th>
    	  <th scope="col">Username</th>
    	  <th scope="col">Title</th>   	 
    	  <th scope="col">Content</th>

    	</tr>
    	<tbody id="myTable">   	    	
        	@foreach($blogs as $blogs)
        	<tr>
        	    <td>{{$blogs->getUserId()}}</td>
        	    <td>{{$blogs->getUsername()}}</td>        	           	
        		<td>{{$blogs->getTitle()}}</td>
        		<td>{{$blogs->getContent()}}</td> 
        	</tr>
        	@endforeach
        </tbody>                		
        </table>
        
        </div>
     </div>
</div>
@endsection