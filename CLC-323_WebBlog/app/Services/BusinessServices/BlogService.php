<?php
namespace App\Services\BusinessServices;

use App\Http\Models\Blog;
use App\Services\DataService\BlogDAO;
use App\Services\Utility\MyLogger;
use Illuminate\Support\Facades\Session;
use mysqli;

class BlogService {
	public function __construct() {
	}
	public function create(Blog $blog) {
		MyLogger::info('Entering create() in BlogService');
		
		// Heroku database
		$db = new mysqli ( "lyn7gfxo996yjjco.cbetxkdyhwsb.us-east-1.rds.amazonaws.com", "u8f7vzzvkj9sn2oc", "ve7sgjbc7cj8mxvc", "f7dacmyrfygsdhw0" );
		//local testing database
		// $db = new mysqli("localhost", "root", "root", "323_webblog");

		// Check connection
		if ($db->connect_errno) {
			MyLogger::info('Exiting create() in BlogService with db connections error');
			
			echo "Failed to connect to MySQL: " . $db->connect_error;
			exit();
		}

		$service = new BlogDAO($db);
		$flag = $service->createBlog($blog);

		// close connection
		$db->close ();

		MyLogger::info('Entering getBlogs() in BlogService with results');
		// return results
		return $flag;
	}
	
	public function getBlogs($USERNAME) {
		MyLogger::info('Entering getBlogs() in BlogService');
		
		// Heroku database
		$db = new mysqli ( "lyn7gfxo996yjjco.cbetxkdyhwsb.us-east-1.rds.amazonaws.com", "u8f7vzzvkj9sn2oc", "ve7sgjbc7cj8mxvc", "f7dacmyrfygsdhw0" );
		// local testing database
		// $db = new mysqli("localhost", "root", "root", "323_webblog");

		// Check connection
		if ($db->connect_errno) {
			MyLogger::info('Exiting getBlogs() in BlogService with db connection error');
			
			echo "Failed to connect to MySQL: " . $db->connect_error;
			exit ();
		}

		$service = new BlogDAO ( $db );
		$blogs = $service->findByUsername ( $USERNAME );

		// close connection
		$db->close();
		
		MyLogger::info('Exiting getBlogs() in BlogService with results');		
		// return results
		return $blogs;
	}
	
	public function getBlogByID($id) {
		MyLogger::info('Entering getBlogByID() in BlogService');
		
		// Heroku database
		$db = new mysqli ( "lyn7gfxo996yjjco.cbetxkdyhwsb.us-east-1.rds.amazonaws.com", "u8f7vzzvkj9sn2oc", "ve7sgjbc7cj8mxvc", "f7dacmyrfygsdhw0" );
		// local testing database
		// $db = new mysqli("localhost", "root", "root", "323_webblog");
		
		// Check connection
		if ($db->connect_errno) {
			MyLogger::info('Exiting getBlogByID() in BlogService with db connection error');
			
			echo "Failed to connect to MySQL: " . $db->connect_error;
			exit ();
		}
		
		$service = new BlogDAO ($db);
		$blog = $service->findByID($id);		
		// close connection
		$db->close();	
		
		MyLogger::info('Exiting getBlogByID() in BlogService with result');
		// return results
		return $blog;
	}
	
	//edit existing blog posting in the database
	public function editPost(Blog $post){
		MyLogger::info('Entering editPost() in BlogService');
		
		// Heroku database
		$db = new mysqli ( "lyn7gfxo996yjjco.cbetxkdyhwsb.us-east-1.rds.amazonaws.com", "u8f7vzzvkj9sn2oc", "ve7sgjbc7cj8mxvc", "f7dacmyrfygsdhw0" );
		// local testing database
		// $db = new mysqli("localhost", "root", "root", "323_webblog");
		
		// Check connection
		if ($db->connect_errno) {
			MyLogger::info('Exiting editPost() in BlogService with db connection error');
			
			echo "Failed to connect to MySQL: " . $db->connect_error;
			exit ();
		}
		//call DAO and pass edited blog
		$security = new BlogDAO($db);
		$result = $security->edit($post);
		
		MyLogger::info('Exiting editPost() in BlogService with result');
		return $result;
	} 
	
	//function to delete blog posts
	public function deletePost($id){
		MyLogger::info('Entering deletePost() in BlogService');
		
		// Heroku database
		$db = new mysqli ( "lyn7gfxo996yjjco.cbetxkdyhwsb.us-east-1.rds.amazonaws.com", "u8f7vzzvkj9sn2oc", "ve7sgjbc7cj8mxvc", "f7dacmyrfygsdhw0" );
		// local testing database
		// $db = new mysqli("localhost", "root", "root", "323_webblog");
		
		//delete the blog
		$service = new BlogDAO($db);
		$result = $service->delete($id);
		//return if the user was deleted
		$db->close();
		
		MyLogger::info('Exiting deletePost() in BlogService with result');
		return $result;
	}
	
	public function getMyBlogs() {
		MyLogger::info('Entering getMyBlogs() in BlogService');
		
		// Heroku database
		$db = new mysqli ( "lyn7gfxo996yjjco.cbetxkdyhwsb.us-east-1.rds.amazonaws.com", "u8f7vzzvkj9sn2oc", "ve7sgjbc7cj8mxvc", "f7dacmyrfygsdhw0" );
		// local testing database
		// $db = new mysqli("localhost", "root", "root", "323_webblog");
		
		// Check connection
		if ($db->connect_errno) {
			MyLogger::info('Exiting getMyBlogs() in BlogService with db connection error');
			
			echo "Failed to connect to MySQL: " . $db->connect_error;
			exit ();
		}
		
		$service = new BlogDAO ($db);
		
		$ID = Session::get('User')->getId();
		$blogs = $service->findMyBlogs($ID);
		
		// close connection
		$db->close();
		
		MyLogger::info('Exiting getMyBlogs() in BlogService with results');
		// return results
		return $blogs;
	}
	
}

