<?php
	class Site
	{
		
		private $db;
		
		public function construct__()
		{
			$this->db = db::getInstance();
		}

		/*
		public static function all() 
		{
			$list = [];
			$db = db::getInstance();
			$req = $db->query('SELECT * FROM sites');

			foreach($req->fetchAll() as $site) {
				$list[] = new User($site['name'], $site['address'], $site['telephone'], $site['email']);
			}
			return $list;
		}

		public static function find($id) 
		{
			$db = db::getInstance();
			$id = intval($id);
			$req = $db->prepare('SELECT * FROM sites WHERE siteID = :id');
			$req->execute(array('id' => $id));
			$user = $req->fetch();

			return new User($site['name'], $site['address'], $site['telephone'], $site['email']);
		}
		*/
		
		public static function getClients( $selector = null )
		{
			$list = $selector != null ? ["<option value='0' selected>$selector</option>"] : [];
			$req = db::getInstance()->query("SELECT id, name FROM ea_services");

			foreach($req->fetchAll() as $client) {
				$list[] = "<option value='{$client['id']}'>{$client['name']}</option>";
			}
			return $list;
		}
		
		public function updateReadData($data)
		{
	
			return $data;
		}
		
		public function afterCreatePost($post)
		{
			$clients_site =
				array(
				  "id_users"    => $post['id'],
				  "id_services" => $post['clientID']
			);
			
			$user_settings = [
				"id_users"     => $post['id'],
				"username"     => $post['first_name'],
				"password"     => '344df2034a7bb6f81c259ae704fdcb87335b7d212dd4e3d75b199a2abab714ce',
				"salt"         => '9772e21762c7962dde6cb75d6638d54e31a13e1ebdb28d869d928e39886c73ff',
				"working_plan" => '{"monday":{"start":"09:00","end":"18:00","breaks":[{"start":"11:20","end":"11:30"},{"start":"14:30","end":"15:00"}]},"tuesday":{"start":"09:00","end":"18:00","breaks":[{"start":"11:20","end":"11:30"},{"start":"14:30","end":"15:00"}]},"wednesday":{"start":"09:00","end":"18:00","breaks":[{"start":"11:20","end":"11:30"},{"start":"14:30","end":"15:00"}]},"thursday":{"start":"09:00","end":"18:00","breaks":[{"start":"11:20","end":"11:30"},{"start":"14:30","end":"15:00"}]},"friday":{"start":"09:00","end":"18:00","breaks":[{"start":"11:20","end":"11:30"},{"start":"14:30","end":"15:00"}]},"saturday":{"start":"09:00","end":"18:00","breaks":[{"start":"11:20","end":"11:30"},{"start":"14:30","end":"15:00"}]},"sunday":{"start":"09:00","end":"18:00","breaks":[{"start":"11:20","end":"11:30"},{"start":"14:30","end":"15:00"}]}}'
			]; 
				
			db::insert_array('ea_services_providers', $clients_site);	
			db::insert_array('ea_user_settings', $user_settings);	
		}
		
		public function updateCreatePOST($post)
		{
			$id = db::next_insertID("ea_users");
			
			$post['last_name'] = ''; // blank
			$post['id'] = $id;
			$post['id_roles'] = 2; // 2 meaning it is 'Site'
			$post["join_date"] = time();
			
			return $post;
		}
		
		public function updateEditPost($id, $post)
		{
			return $post;
		}
	}
?>
	