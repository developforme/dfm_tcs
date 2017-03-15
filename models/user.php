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
					$req = $db->prepare("SELECT id FROM users WHERE id = '{$dfm_user}' AND password = '{$dfm_pwd}'");
					$req->execute(array('id' => $dfm_user));
					
					while($user = $req->fetch()) {
						return $user['id'];
					}
				}
			}
		}
		
		public static function find($id) 
		{
			$id = intval($id);
			$db = db::getInstance();
			$req = $db->prepare("SELECT * FROM users WHERE id = :id");
			$req->execute(array('id' => $id));
			$user = $req->fetch();

			$join_date = date("d/m/Y H:i", $user['join_date']);
			$last_login = date("d/m/Y H:i", $user['last_login']);
			
			return $user;
		}
	}
?>
	