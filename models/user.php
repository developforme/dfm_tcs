<?php
	class User
	{
		private $dbh;
		
		public function __construct() 
		{
			$this->dbh = db::getInstance();
		}

		public static function userID()
		{
			if(isset($_COOKIE['dfm_auth']))
			{
				$authent = explode(":", $_COOKIE['dfm_auth']);
				
				$dfm_user = $authent[0];
				$dfm_pwd  = $authent[1];
				
				if(isset($dfm_user) && isset($dfm_pwd))
				{
					$db = db::getInstance();
					$req = $db->prepare("SELECT id_users FROM ea_user_settings WHERE id_users = '{$dfm_user}' AND password = '{$dfm_pwd}'");
					$req->execute(array('id' => $dfm_user));
					
					while($user = $req->fetch()) {
						return $user['id_users'];
					}
				}
			}
		}
		
		public static function find($id) 
		{
			$id = intval($id);
			$db = db::getInstance();
			$req = $db->prepare("SELECT u.id, us.salt, us.username, u.first_name, u.last_name, u.email, u.join_date, u.last_login FROM ea_users u, ea_user_settings us WHERE u.id = us.id_users AND u.id_roles = 1 AND id = :id");
			$req->execute(array('id' => $id));
			$user = $req->fetch();

			$join_date = date("d/m/Y H:i", $user['join_date']);
			$last_login = date("d/m/Y H:i", $user['last_login']);
			
			return $user;
		}
		
		public function updateReadData($data)
		{
			return $data;
		}
		
		public function afterCreatePost($post)
		{
			
			$new_salt = dfm::generate_salt();
			$password = dfm::hash_password($new_salt, $post['password']);	

			$user_settings = [
				"id_users"     => $post['id'],
				"username"     => $post['username'],
				"password"     => $password,
				"salt"         => $new_salt
			]; 
				
			db::insert_array('ea_user_settings', $user_settings);	
		}
		
		public function updateCreatePOST($post)
		{
			$id = db::next_insertID("ea_users");
			
			$full_name = explode(" ", $post['first_name']);
			$post['first_name'] = $full_name[0];
			$post['last_name'] = isset($full_name[1]) ? $full_name[1] : '';
			
			$post['id'] = $id;
			$post['id_roles'] = 1; // 1 meaning it is 'System User'
			$post["join_date"] = time();
			
			return $post;
		}
		
		public function updateEditPost($id, $post)
		{
			
			
			$full_name = explode(" ", $post['first_name']);
			$post['first_name'] = $full_name[0];
			$post['last_name'] = isset($full_name[1]) ? $full_name[1] : '';
			
			$user = self::find($id);
			$post["password"] = dfm::hash_password($user->salt, $post['password']);
			
			return $post;
		}
	}
?>
	