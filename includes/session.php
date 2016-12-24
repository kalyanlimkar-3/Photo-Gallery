<?php
	/*
	A class to help work with Sessions
	In our case, primarily to manage logging users in and out
	
	Keep in mind when working with sessions that it is generally inadvisable to store DB-related objects in sessions
	You can store the id for the object instead of the entire object data
	The reason is that data in session can become stale
	Database can be updated by other users in the system while the session has still the old version of the data saved within the file
	It is better to store the id of the object and get the fresh copy of data from the database when needed
	*/

	class Session {
		
		private $logged_in = false;
		public $user_id;
		
		function __construct() {
			session_start();
			$this->checklogin();
		}
		
		public function is_logged_in() {
			return $this->logged_in;
		}
		
		public function login($user) {
			if($user) {
				$this->user_id = $_SESSION['user_id'] = $user->id;
				$this->logged_id = true;
			}
		}
		
		public function logout() {
			unset($_SESSION['user_id']);
			unset($this->user_id);
			$this->logged_in = false;
		}
		
		public function checklogin() {
			if(isset($_SESSION['user_id'])) {
				$this->user_id = $_SESSION['user_id'];
				$this->logged_in = true;
			}
			else {
				unset($this->user_id);
				$this->logged_in = false;
			}
		}
		
	}
	
	$session = new Session();
?>