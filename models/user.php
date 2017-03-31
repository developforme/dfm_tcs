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
		
		public function updateCreatePOST($post)
		{
			
			
			$post["password"] = md5($post['password']);
			$post["join_date"] = time();
			
			return $post;
		}
		
		public function updateEditPost($id, $post)
		{
			
			$user = self::find($id);
			$post["password"] = dfm::hash_password($user->salt, $post['password']);
			
			return $post;
		}
	}
?>
	