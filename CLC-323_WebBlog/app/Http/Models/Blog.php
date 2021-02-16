<?php

namespace App\Http\Models;

class Blog {
	//add id to retrieve only blog info matching session userID
	private $id;
	private $userId;
	private $username;
	private $title;	
	private $content;
	
	public function __construct( $Id, $Userid, $Username, $Title, $Content) {
		$this->id = $Id;
		$this->userId = $Userid;
		$this->username = $Username;
		$this->title = $Title;		
		$this->content = $Content;
	}
	//blog id
	public function getId(){
		return $this->id;
	}
	
	//userId
	public function getUserId() {
		return $this->userId;
	}
	public function setUserId($USERID){
		$this->userId = $USERID;
	}
	
	//username
	public function getUsername() {
		return $this->username;
	}
	public function setUsername($USERNAME){
		$this->username=$USERNAME;
	}
	
	//blog title
	public function getTitle() {
		return $this->title;
	}
	public function setTitle($TITLE){
		$this->title=$TITLE;
	}
	
	//blog content
	public function getContent() {
		return $this->content;
	}
	public function setContent($CONTENT){
		$this->content=$CONTENT;
	}

}
