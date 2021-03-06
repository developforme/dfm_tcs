<?php
	class crud
	{
		private $controller;
		private $num_rec_per_page;
		private $table;
		private $dbh;
		private $attributes;
		
		public function __construct( $controller, $table, $attributes, $num_rec_per_page = 10 ) 
		{
			$this->controller = $controller;
			$this->num_rec_per_page = $num_rec_per_page;
			$this->dbh = db::getInstance();
			$this->attributes = $attributes;
			
			if (!is_array($table) )
			{
				$this->table = [
					"create" => $table,
					"read"   => $table, 
					"update" => $table, 
					"delete" => $table
				];
			}
			else{
				$this->table = $table;
			}
		}
				
		public function getData()
		{				
			if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
			$start_from = ($page-1) * $this->num_rec_per_page;

			$where = empty($this->attributes["where"]) ? "" : "WHERE " .$this->attributes["where"];
			
			$req = $this->dbh->prepare("SELECT id, " . implode(", ", array_keys( $this->attributes["index"] ) ) . " FROM {$this->table['read']} {$where} ORDER BY id DESC LIMIT {$start_from}, {$this->num_rec_per_page}");
			$req->execute();
			
			$data['data'] = $req->fetchAll(PDO::FETCH_ASSOC);		
			$data['total'] = db::num_rows("SELECT * FROM {$this->table['read']}");

			return $data;	
		}

		public function createData($post)
		{				
			// Get the keys (field names from controller's table_attributes)
			$keys = Array();
			
			foreach ($this->attributes["create_attributes"] as $key => $value) 
			{
				if( array_key_exists('exclude', $value) ) {
					unset($post[$value['name']]);
				}
				
				if( !array_key_exists('exclude', $value) ) {
					array_push($keys, $value['name']);
				}
			}			
			
			//dfm::system_error("INSERT INTO {$this->table['create']} (".implode(', ', $keys).") VALUES (".implode(', ', $post).")");
			
			// Combine the field name keys with the POST values
			$array = array_combine($keys, $post);

			// Insert SQL
			db::insert_array($this->table['create'], $array);
			
			// Fetch new results
			$req = $this->dbh->prepare("SELECT * FROM {$this->table['read']} Order by id desc LIMIT 1");	
			$data   = $req->fetch(PDO::FETCH_ASSOC);

			// Encode JSON for AJAX script
			return json_encode($data);
		}
		
		public function deleteData($id)
		{				
			$sth = $this->dbh->prepare("DELETE FROM {$this->table['delete']} WHERE id = {$id}");
			$sth->execute();
			return json_encode([$id]);
		}
		
		public function updateData($id, $post)
		{
			// Get the keys (field names from controller's table_attributes)
			$keys = Array();
			
			foreach ($this->attributes["update_attributes"] as $key => $value) {
				array_push($keys, $value['name']);
			}			
			
			// Primary key "id" is required in ARRAY to update specific row so we push it at the end of the array
			array_push($keys, "id");
			
			// Combine the field name keys with the POST values
			$array = array_combine($keys, $post);

			// Insert SQL
			db::update_array($id, $this->table['update'], $array);
					
			// Fetch new results
			$req = $this->dbh->prepare("SELECT * FROM {$this->table['read']} WHERE id = {$id}");	
			$data   = $req->fetch(PDO::FETCH_ASSOC);

			// Encode JSON for AJAX script
			return json_encode($data);	
		}
	}
?>