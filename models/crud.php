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
			$this->table = $table;
			$this->dbh = db::getInstance();
			$this->attributes = $attributes;
		}
				
		public function getData()
		{				
			if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
			$start_from = ($page-1) * $this->num_rec_per_page;

			$req = $this->dbh->prepare("SELECT id, " . implode(", ", array_keys( $this->attributes["index"] ) ) . " FROM {$this->table} ORDER BY id DESC LIMIT {$start_from}, {$this->num_rec_per_page}");
			$req->execute();
			
			$data['data'] = $req->fetchAll(PDO::FETCH_ASSOC);
			$data['total'] = db::num_rows("SELECT * FROM {$this->table}");

			return json_encode($data);		
		}

		public function createData($post, $user = null)
		{		
			$keys = $this->attributes["create"];
			$array = array_combine($keys, $post);

			db::insert_array($this->table, $array);
			
			$req = $this->dbh->prepare("SELECT * FROM {$this->table} Order by id desc LIMIT 1");	
			$data   = $req->fetch(PDO::FETCH_ASSOC);

			return json_encode($data);
		}
		
		public function deleteData($id)
		{				
			$sth = $this->dbh->prepare("DELETE FROM {$this->table} WHERE id = {$id}");
			$sth->execute();
			return json_encode([$id]);
		}
		
		/* temporary solution to be changed */
		public function updateData($id, $post, $user = null)
		{
			$keys = $this->attributes["update"];
			$array = array_combine($keys, $post);
			
			/*
			* DEBUG 
			$err = "";
			
			foreach($post as $p)
			$err .= $p . "\r\n";
			
			$err .= "\r\n";
			
			foreach($keys as $k)
			$err .= $k . "\r\n";

			file_put_contents('error.log',$err, FILE_APPEND);  
			*/
			
			db::update_array($id, $this->table, $array);
					
			$req = $this->dbh->prepare("SELECT * FROM {$this->table} WHERE id = {$id}");	
			$data   = $req->fetch(PDO::FETCH_ASSOC);

			return json_encode($data);
							
		}
	}
?>