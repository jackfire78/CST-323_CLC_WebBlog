<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Models\Blog;
use App\Services\BusinessServices\BlogService;
use App\Services\Utility\MyLogger;

class BlogController extends Controller {
	// function for adding new blog posts
	public function addBlog(Request $request) {
		MyLogger::info ( 'Entering addBlog() in Blog Controller' );

		// get the posted Form Data
		$userid = Session::get ( 'User' )->getId ();
		$username = $request->input ( 'username' );
		$title = $request->input ( 'blogTitle' );
		$content = $request->input ( 'blogContent' );

		// save data to Blog Object Model
		$blog = new Blog ( null, $userid, $username, $title, $content );

		// create blog service and send blog
		$service = new BlogService ();
		$status = $service->create ( $blog );

		// rendered failed or success view and pass $blog to it
		if ($status) {
			return view ( 'BlogAddSuccess' );
		} else {
			return view ( 'BlogAddFailure' );
		}
	}
	// functino to search all blog posts
	public function searchBlogs(Request $request) {
		// get the posted Form Data
		$username = $request->input ( 'username' );

		// create blog service and send $username
		$service = new BlogService ();
		$blogs = $service->getBlogs ( $username );

		// rendered failed or success view
		if ($blogs) {
			return view ( 'showBlogSearch' )->with ( "blogs", $blogs );
		} else {
			return view ( 'BlogSearchFailure' );
		}
	}
	
	// function to get one post (mainly used for edit blog post)
	public function getPost(Request $request) {
		// get the posted Form Data
		$id = $request->input ('id');
		
		// create blog service and send $id
		$service = new BlogService ();
		$blog = $service->getBlogByID ($id);
		
		// rendered failed or success view
		if ($blog) {
			return view ('editBlogPost')->with ("blog", $blog);
		}else{
			return view ('editBlogFailure');
		}
	}
	
	//Function will update the information on selected blog posting
	public function editPost(Request $request){			
		//pull form data to make a change
		//extract data to send to the service
		$id = $request->input('id');
		$userid = Session::get ( 'User' )->getId ();		
		$username = $request->input ( 'username' );
		$title = $request->input ( 'blogTitle' );
		$content = $request->input ( 'blogContent' );
		
		//create new object
		$newPost = new Blog($id, $userid, $username, $title, $content);
		//pass the blog object to the service
		$service = new BlogService();
		$result = $service->editPost($newPost);
		
		if($result == "true"){
			return $this->myBlogs();
		}else{
			return view('editBlogFailure');
		}
	}

	// Function to delete a job posting
	public function deletePost(Request $request) {
		// get the id
		$id = $request->input ( 'id' );
		// create new service
		$service = new BlogService ();
		// call the delete job post using the passed Id
		$result = $service->deletePost ( $id );
		if ($result) {
			// if result is true then deletion worked. Take user back to myblogs page
			//return view ( 'showHomePage' );
			return $this->myBlogs();
		} else {
			// otherwise take user to error page
			return view ( 'blogDeleteError' );
		}
	}

	// function to retrieve current logged in user's blog posts
	public function myBlogs() {
		// create blog service and call getMyBlogs
		$service = new BlogService ();
		$blogs = $service->getMyBlogs ();

		// rendered failed or success view
		if ($blogs) {
			return view ( 'MyBlogs' )->with ( "blogs", $blogs );
		} else {
			return view ( 'MyBlogsFailed' );
		}
	}
}