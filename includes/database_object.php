<?php
	require_once(LIB_PATH.DS."database.php");

	class DatabaseObject {
		public static function find_all() {
			return static::find_by_sql("SELECT * FROM " . static::$table_name);
		}		
		public static function find_by_id($id = 0) {
			$result_array = static::find_by_sql("SELECT * FROM " . static::$table_name . " WHERE id={$id} LIMIT 1");			
			return !empty($result_array) ? array_shift($result_array):false;
		}		
		private static function find_by_sql($sql = "") {
			global $db;
			
			$result_set = $db->query($sql);
			$object_array = array();
			while($row = $db->fetch_array($result_set, MYSQL_ASSOC))
				$object_array[] = static::instantiate($row);
			
			return $object_array;
		}		
		private static function instantiate($record) {
			$object = new static;
			foreach($record as $attribute => $value)
				if($object->has_attribute($attribute))
					$object->$attribute = $value;
			
			return $object;
		}
		private function has_attribute($attribute) {
			$object_vars = get_object_vars($this);		// returns an associative array with all attributes (including private ones) as the keys and their current values as value
			return array_key_exists($attribute, $object_vars);		// returns if the attribute is exists
		}
	}
?>