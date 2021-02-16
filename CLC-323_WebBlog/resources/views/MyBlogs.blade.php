@extends('layouts.appmaster')
@section('head','Search Blogs')
@section('title', 'Search Results')
@section('content')

<!-- Blog Postings -->

<br/><br/>
<div class = "container">   
    <div class= "row justify-content-center">
    	<div class = "col">
        
    	<table class="table table-dark">
    	<tr>
    	  <th scope="col">User Id</th>
    	  <th scope="col">Username</th>
    	  <th scope="col">Title</th>   	 
    	  <th scope="col">Content</th>
    	  <th scope="col">Actions</th>

    	</tr>
    	<tbody id="myTable">
        	@foreach($blogs as $blogs)
        	<tr>       	
        	    <td>{{$blogs->getUserId()}}</td>
        	    <td>{{$blogs->getUsername()}}</td>        	           	
        		<td>{{$blogs->getTitle()}}</td>
        		<td>{{$blogs->getContent()}}</td>
        		<td>
        		<form action="PostEditPage" method="post">
        			<input type="hidden" name="_token" value="{{csrf_token()}}"/>
        			<input type="hidden" name="id" value="{{$blogs->getId()}}">         			        
	    			<button type="submit" class="btn btn-primary">Edit</button>
	    		</form>
        		<form action="deletePost" method="post">
        			<input type="hidden" name="_token" value="{{csrf_token()}}"/>
        			<input type="hidden" name="id" value="{{$blogs->getId()}}">         			        
	    			<button type="submit" class="btn btn-primary">Delete</button>
	    		</form>
	    		
	    		</td>
        	</tr>
        	@endforeach
        </tbody>                		
        </table>
        
        </div>
     </div>
</div>
@endsection