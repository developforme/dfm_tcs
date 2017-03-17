<?php
	class db
	{
		private static $instance = NULL;

		private function __construct() {}

		private function __clone() {}

		public static function getInstance() 
		{
			try
			{
				require_once($_SERVER['DOCUMENT_ROOT'] . "/dfm/tcs_project/connection.php");

				if (!isset(self::$instance)) 
				{
					$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
					self::$instance = new PDO("mysql:host={$db_host};dbname={$db_name}", $db_user, $db_pass, $pdo_options);
				}
				
				return self::$instance;
			}
			catch(PDOException $err)
			{
				$err->getMessage() . "<br/>";
				file_put_contents('error.log',$err, FILE_APPEND);   
				return $err->getMessage();
			}
		}
		
		public static function update_array($id, $table, $data, $exclude = array())
		{
			$fields = array();
			
			if( !is_array($exclude) ) $exclude = array($exclude);

			foreach($data as $field => $val) 
			{
				if( !in_array($field, $exclude) ) {
					$fields[] = "{$field} = '{$val}'";
				}
			}

			$sql = "UPDATE {$table} SET " . join(', ', $fields) . " WHERE id = '{$id}'";
			
			file_put_contents('error.log',$sql, FILE_APPEND);  
			
			$sth = self::getInstance()->prepare($sql);
			$sth->execute();
		}
		
		public static function update_array2($table, $array) 
		{
			$id = array_shift($array);
			$fields = array();

			foreach($array as $field => $val) {
			   $fields[] = "$field = '$val'";
			}

			$sql = "UPDATE {$table} SET " . join(', ', $fields) . " WHERE id = '$id'";

			$sth = self::getInstance()->prepare($sql);
			$sth->execute();
		}

		public static function insert_array($table, $data, $exclude = array()) 
		{
			$fields = $values = array();

			if( !is_array($exclude) ) $exclude = array($exclude);

			foreach( array_keys($data) as $key ) 
			{
				if( !in_array($key, $exclude) ) {
					$fields[] = "`$key`";
					$values[] = self::escape($data[$key]);
				}
			}

			$fields = implode(", ", $fields);
			$values = implode(", ", $values);

			$sql = "INSERT INTO " . $table;
			
			if( $fields != null ) {
				$sql .= "(".$fields.") ";
			}
			
			$sql .= "VALUES(".$values.")";

			$sth = self::getInstance()->prepare($sql);
			$sth->execute();
		}
		
		public static function escape($str)
		{
			return self::getInstance()->quote($str);
		}
		
		public static function num_rows($sql)
		{
			$req = self::getInstance()->prepare($sql);
			$req->execute();
			return $req->fetchColumn();
		}
	}
?>
