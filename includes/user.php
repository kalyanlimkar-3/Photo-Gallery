<?php
	require_once(LIB_PATH.DS."database.php");

	class User extends DatabaseObject {
		

		public $id;
		public $username;
		public $password;
		public $first_name;
		public $last_name;
		protected static $table_name = "users";
				
		public function full_name() {
			if(isset($this->first_name) && isset($this->last_name))
				return $this->first_name . " " . $this->last_name;
			return "";
		}
		public static function authenticate($username = "", $password = "") {
			global $database;
			
			$username = $database->escape_value($username);
			$password = $database->escape_value($password);
			
			$sql = "SELECT * FROM users ";
			$sql .= "WHERE username = '{$username}' ";
			$sql .= "AND password = '{$password}' ";
			$sql .= "LIMIT 1";
			
			$result_array = self::find_by_sql($sql);
			return !empty($result_array) ? array_shift($result_array) : false;
		}
				
		// Common Database Methods

		/*public static function find_all() {
			return self::find_by_sql("SELECT * FROM " . self::$table_name);
		}		
		public static function find_by_id($id = 0) {
			$result_array = self::find_by_sql("SELECT * FROM " . self::$table_name " WHERE id={$id} LIMIT 1");			
			return !empty($result_array) ? array_shift($result_array):false;
		}		
		private static function find_by_sql($sql = "") {
			global $db;
			
			$result_set = $db->query($sql);
			$object_array = array();
			while($row = $db->fetch_array($result_set, MYSQL_ASSOC))
				$object_array[] = self::instantiate($row);
			
			return $object_array;
		}		
		private static function instantiate($record) {
			//$object = new User($record);
			$object = new self;
			foreach($record as $attribute => $value)
				if($object->has_attribute($attribute))
					$object->$attribute = $value;
			
			return $object;
		}
		private function has_attribute($attribute) {
			$object_vars = get_object_vars($this);		// returns an associative array with all attributes (including private ones) as the keys and their current values as value
			return array_key_exists($attribute, $object_vars);		// returns if the attribute is exists
		}*/
	}
?>