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

			$req = $this->dbh->prepare("SELECT id, " . implode(", ", array_keys( $this->attributes ) ) . " FROM {$this->table} ORDER BY id DESC LIMIT {$start_from}, {$this->num_rec_per_page}");
			$req->execute();
			
			$data['data'] = $req->fetchAll(PDO::FETCH_ASSOC);
			$data['total'] = db::num_rows("SELECT * FROM {$this->table}");

			return json_encode($data);		
		}

		/* temporary solution to be changed */
		public function createData($post, $user = null)
		{		
			if($user != null)
			{
				$arr = array(
						"username" => $post['username'],
						"fullname" => $post['fullname'],
						"email"    => $post['email'],
						"password" => md5($post['password'])
					   );
			
			}
			else{
		
				$arr = array(
						"name"      => $post['name'],
						"address"   => $post['address'],
						"telephone" => $post['telephone'],
						"email"     => $post['email']
					   );
			}
				   
			db::insert_array($this->table, $arr);
			
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
			
			if($user != null)
			{
				$update_sql = "
					username = '{$post['username']}',
					fullname = '{$post['fullname']}',
					email =    '{$post['email']}'
					";
			}
			else{
			
				$update_sql = "
					name =      '{$post['name']}',
					address =   '{$post['address']}',
					telephone = '{$post['telephone']}',
					email =     '{$post['email']}'
					";			
			}
			
			$sth = $this->dbh->prepare("UPDATE {$this->table} SET {$update_sql} WHERE id = {$id}");
			$sth->execute();
						
			$req = $this->dbh->prepare("SELECT * FROM {$this->table} WHERE id = {$id}");	
			$data   = $req->fetch(PDO::FETCH_ASSOC);

			return json_encode($data);
							
		}
		
	}
?>