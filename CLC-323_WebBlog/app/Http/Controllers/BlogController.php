<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Models\Blog;
use App\Services\BusinessServices\BlogService;
use App\Services\Utility\MyLogger;
/**
 * @author Jack Setrak
 * Milestone 5 (4-14-2021)
 * Controller that deals with all Blog related methods. Handles all form requests and validation before
 * sending information down to Business service.
 * Contributions: Jack Setrak
 */
class BlogController extends Controller {	
	// function for adding new blog posts
	public function addBlog(Request $request) {		
		MyLogger::info('Entering addBlog() in BlogController');
		
		$this->validateForm($request);
		
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
			MyLogger::info('Exiting addBlog() in BlogController with success');
			return view ( 'BlogAddSuccess' );
		} else {
			MyLogger::info('Exiting addBlog() in BlogController with failure');
			return view ( 'BlogAddFailure' );
		}
	}
	// functino to search all blog posts
	public function searchBlogs(Request $request) {
		MyLogger::info('Entering searchBlogs() in BlogController');
		
		$this->validateForm($request);
		
		// get the posted Form Data
		$username = $request->input ( 'username' );

		// create blog service and send $username
		$service = new BlogService ();
		$blogs = $service->getBlogs ( $username );

		// rendered failed or success view
		if ($blogs) {
			MyLogger::info('Exiting searchBlogs() in BlogController with success');
			
			return view ( 'showBlogSearch' )->with ( "blogs", $blogs );
		} else {
			MyLogger::info('Exiting searchBlogs() in BlogController with failure');
			return view ( 'BlogSearchFailure' );
		}
	}
	
	// function to get one post (mainly used for edit blog post)
	public function getPost(Request $request) {
		MyLogger::info('Entering getPost() in BlogController');
		
		$this->validateForm($request);
		
		// get the posted Form Data
		$id = $request->input ('id');
		
		// create blog service and send $id
		$service = new BlogService ();
		$blog = $service->getBlogByID ($id);
		
		// rendered failed or success view
		if ($blog) {
			MyLogger::info('Exiting getPost() in BlogController with success');
			return view ('editBlogPost')->with ("blog", $blog);
		}else{
			MyLogger::info('Exiting getPost() in BlogController with failure');
			return view ('editBlogFailure');
		}
	}
	
	//Function will update the information on selected blog posting
	public function editPost(Request $request){	
		MyLogger::info('Entering editPost() in BlogController');
	
		$this->validateForm($request);
		
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
			MyLogger::info('Exiting editPost() in BlogController with success');
			return $this->myBlogs();
		}else{
			MyLogger::info('Exiting editPost() in BlogController with failure');
			return view('editBlogFailure');
		}
	}

	// Function to delete a job posting
	public function deletePost(Request $request) {
		MyLogger::info('Entering deletePost() in BlogController');
		
		$this->validateForm($request);
		
		// get the id
		$id = $request->input ( 'id' );
		// create new service
		$service = new BlogService ();
		// call the delete job post using the passed Id
		$result = $service->deletePost ( $id );
		if ($result) {
			MyLogger::info('Exiting deletePost() in BlogController with success');
			// if result is true then deletion worked. Take user back to myblogs page
			//return view ( 'showHomePage' );
			return $this->myBlogs();
		} else {
			MyLogger::info('Exiting deletePost() in BlogController with failure');
			// otherwise take user to error page
			return view ( 'blogDeleteError' );
		}
	}

	// function to retrieve current logged in user's blog posts
	public function myBlogs() {
		MyLogger::info('Entering myBlogs() in BlogController');
				
		// create blog service and call getMyBlogs
		$service = new BlogService ();
		$blogs = $service->getMyBlogs ();

		// rendered failed or success view
		if ($blogs) {
			MyLogger::info('Exiting myBlogs() in BlogController with success');
			return view ( 'MyBlogs' )->with ( "blogs", $blogs );
		} else {
			MyLogger::info('Exiting myBlogs() in BlogController with failure');
			return view ( 'MyBlogsFailed' );
		}
	}
		
	/**
	 * Validate search form
	 * @param Request $request
	 */
	private function validateSearchForm(Request $request){
		$rules = ['username' => 'Required'];	
		//run data validation rules
		$this->validate($request, $rules);
	}
	
	/**
	 * Validate submit form
	 * @param Request $request
	 */
	private function validateSubmitForm(Request $request){
		$rules = ['username' => 'Required',
				'blogTitle' => 'Required',
				'blogContent' => 'Required'];
		
		//run data validation rules
		$this->validate($request, $rules);
	}
	/**
	 * Validate edit form
	 * @param Request $request
	 */
	private function validateEditForm(Request $request){
		$rules = ['username' => 'Required',
				'blogTitle' => 'Required',
				'blogContent' => 'Required'];
		
		//run data validation rules
		$this->validate($request, $rules);
	}
	
	
	
}
