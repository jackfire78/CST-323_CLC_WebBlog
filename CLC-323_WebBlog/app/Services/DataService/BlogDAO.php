<?php

namespace App\Services\DataService;

use PDOException;
use App\Http\Models\Blog;
use App\Services\Utility\DatabaseException;
use App\Services\Utility\MyLogger;

class BlogDAO { 
	private $db;
	
	public function __construct($db) {
		$this->db = $db;
	}
	
	public function createBlog(Blog $blog) {
		MyLogger::info('Entering createBlog() in BlogDAO');
		
		$id = $blog->getUserId();
		$user = $blog->getUsername();
		$title = $blog->getTitle();		
		$content = $blog->getContent();

		try {
			//connect to database
			if ($this->db->connect_error){
				echo "Failed to get databse connection!";
			}else{
				//insert into db
				$sql_statement = "INSERT INTO `blogs` (`USERID`,`USERNAME`, `TITLE`, `CONTENT`) VALUES ('$id','$user', '$title', '$content');";
				if (mysqli_query($this->db, $sql_statement)) {
					MyLogger::info('Exiting createBlog() in BlogDAO with true');			
					//echo $sql_statement;
					return true;
				}else{
					MyLogger::info('Exiting createBlog() in BlogDAO with false');
					return false;
				}
			}
		} catch ( PDOException $e ) {
			MyLogger::info('Exiting createBlog() in BlogDAO with PDOexception');		
			throw new DatabaseException ( "Database Exception: " . $e->getMessage (), 0, $e );
		} 
	}
	//retrieve all blog posts matching inputed username
	public function findByUsername($username) {
		MyLogger::info('Entering findByUsername() in BlogDAO');
		
		try {
			$sql_statement =  "SELECT * FROM `blogs` WHERE `USERNAME` LIKE '%$username%'";
				$counter = 0;
				$result = mysqli_query($this->db, $sql_statement);
				//run the statment
				if($result){
					//loop through all results to create models to make an array
					while($row = mysqli_fetch_assoc($result)){
						//create new model to send back
						$blog = new Blog ( $row ['ID'], $row ['USERID'], $row ['USERNAME'], $row ['TITLE'], $row ['CONTENT'] );
						//add the new models to an array to return
						$array[$counter] = $blog;
						$counter++;
					}
					if(isset($array)){
						MyLogger::info('Exiting findByUsername() in BlogDAO with populatedArray');
						//if something is in the array return it
						return $array;
					}else{
						MyLogger::info('Exiting findByUsername() in BlogDAO with emptyArray');	
						//return if empty
						$empty=array();
						return $empty;
					}
				}
		} catch ( PDOException $e ) {
			MyLogger::info('Exiting findByUsername() in BlogDAO with PDOException');
			throw new DatabaseException ( "Database Exception: " . $e->getMessage (), 0, $e );
		}
	}
	
	//retrieve a blog post matching passed $id
	public function findByID($id) {
		MyLogger::info('Entering findByID() in BlogDAO');
		
		try {
			$sql_statement =  "SELECT * FROM `blogs` WHERE `ID` = '$id'";
			$result = mysqli_query($this->db, $sql_statement);
			//run the statment
			if($result){
				while($row = mysqli_fetch_assoc($result)){
					//create new model to send back
					$blog = new Blog ( $row ['ID'], $row ['USERID'], $row ['USERNAME'], $row ['TITLE'], $row ['CONTENT'] );
					//return this new model
					MyLogger::info('Exiting findByID() in BlogDAO with blog result');
					return $blog;
				}
			}
		} catch ( PDOException $e ) {
			MyLogger::info('Exiting findByID() in BlogDAO with PDOException');
			throw new DatabaseException ( "Database Exception: " . $e->getMessage (), 0, $e );
		}
	}
	
	//modifies post when requested
	public function edit(Blog $blog){
		MyLogger::info('Entering edit() in BlogDAO');
		
		//get all variables from blog parameter
		$id = $blog->getId();
		$user = $blog->getUsername();
		$title = $blog->getTitle();
		$content = $blog->getContent();		
		
		//connect to database
		if ($this->db->connect_error){
			echo "Failed to get databse connection!";
		}else{
			//update db blog where id matches
			$sql_statement = "UPDATE `blogs` SET `USERNAME` = '$user', `TITLE` = '$title', `CONTENT` = '$content' WHERE `blogs`.`ID` = '$id';";
			if (mysqli_query($this->db, $sql_statement)) {
				//echo "Blog edited successfully";
				MyLogger::info('Exiting edit() in BlogDAO with true');
				
				return true;
			}
		}	
	}
	
	public function delete($id){
		MyLogger::info('Entering delete() in BlogDAO');
		
		try{
			if ($this->db->connect_error){
				//check the connection
				echo "Failed to get databse connection!";
			}else{
				//running the statement
				$sql_statement = "DELETE FROM `blogs` WHERE `ID` = '$id'";
				$result = mysqli_query($this->db, $sql_statement);
				if($result){
					MyLogger::info('Exiting delete() in BlogDAO with true');				
					//returning if the user was deleted
					return true;
				}else{
					MyLogger::info('Exiting delete() in BlogDAO with false');
					return false;
				}
			}
		} catch ( PDOException $e ) {
			MyLogger::info('Exiting delete() in BlogDAO with PDOException');		
			throw new DatabaseException ( "Database Exception: " . $e->getMessage (), 0, $e );
		}
	}
	
	//retrieve all of current logged in user's blogs
	public function findMyBlogs($id) {
		MyLogger::info('Entering findMyBlogs() in BlogDAO');
		
		try {
			$sql_statement =  "SELECT * FROM `blogs` WHERE `USERID` LIKE '%$id%'";
			$counter = 0;
			$result = mysqli_query($this->db, $sql_statement);
			//run the statment
			if($result){
				//loop through all results to create models to make an array
				while($row = mysqli_fetch_assoc($result)){
					//create new model to send back
					$blog = new Blog ( $row ['ID'], $row ['USERID'], $row ['USERNAME'], $row ['TITLE'], $row ['CONTENT'] );
					//add the new models to an array to return
					$array[$counter] = $blog;
					$counter++;
				}
				if(isset($array)){
					MyLogger::info('Exiting findMyBlogs() in BlogDAO with populatedArray');
					//if something is in the array return it
					return $array;
				}else{
					MyLogger::info('Exiting findMyBlogs() in BlogDAO with emptyArray');
					//return if empty
					$empty=array();
					return $empty;
				}
			}
		} catch ( PDOException $e ) {
			MyLogger::info('Exiting findMyBlogs() in BlogDAO with PDOException');
			throw new DatabaseException ( "Database Exception: " . $e->getMessage (), 0, $e );
		}
	}
	
}

