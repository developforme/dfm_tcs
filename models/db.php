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
		
		// Get data
		public static function getData( $sql = array("SELECT" => '', "FROM" => '' ), $fetch = "fetch" )
		{
			$db = db::getInstance();
			
			$where = array_key_exists("WHERE", $sql) ? " WHERE ".$sql['WHERE'] : '';
			$order = array_key_exists("ORDER", $sql) ? " ORDER BY ".$sql['ORDER'] : '';
			$limit = array_key_exists("LIMIT", $sql) ? " LIMIT ".$sql['LIMIT'] : '';
			
			$sth = self::getInstance()->prepare(array_keys($sql)[0] . " " .  array_values($sql)[0] . " FROM {$sql['FROM']} {$where} {$order} {$limit}");
			$sth->execute();

			return $fetch == "all" ? $sth->fetchAll() : $sth->fetch();
		}
		
		// List fields
		public static function list_fields($table) 
		{	 
			$sql = array(
			  "SHOW"   => "COLUMNS",
			  "FROM"   => $table
			);
		
			foreach(self::getData($sql, 'all') as $row){
				$fieldnames[] = $row['Field']; 
			}
	 
			return $fieldnames;
		} 
		
		public static function next_insertID($table) 
		{
			$fields = self::list_fields($table);
			$id = $fields[0];
			
			$sql = array(
			  "SELECT" => $id,
			  "FROM"   => $table,
			  "ORDER"  => $id . ' DESC',
			  "LIMIT"  => '0, 1'
			);
			
			$last_id = self::getData($sql);
			return !$last_id[$id] ? 1 : $last_id[$id] + 1;
		}
		
		public static function update_array($id, $table, $data, $exclude = array(), $identifer = "id")
		{
			$fields = array();
			
			if( !is_array($exclude) ) $exclude = array($exclude);

			foreach($data as $field => $val) 
			{
				if( !in_array($field, $exclude) ) {
					$fields[] = "{$field} = '{$val}'";
				}
			}

			$sql = "UPDATE {$table} SET " . join(', ', $fields) . " WHERE {$identifer} = '{$id}'";
			
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
