<?php
	class User
	{
		public $userID;
		public $username;
		public $email;
		public $fullname;
		public $join_date;
		public $last_login;

		public function __construct($userID, $username, $email, $fullname, $join_date, $last_login) 
		{
			$this->user_id    = $userID;
			$this->email      = $email;
			$this->fullname   = $fullname;
			$this->username   = $username;
			$this->join_date  = $join_date;
			$this->last_login = $last_login;
		}

		public static function all() 
		{
			$list = [];
			$db = Db::getInstance();
			$req = $db->query('SELECT * FROM users');
			
			

			foreach($req->fetchAll() as $user) {
				
				$join_date = date("d/m/Y H:i", $user['join_date']);
				$last_login = date("d/m/Y H:i", $user['last_login']);
				$list[] = new User($user['userID'], $user['username'], $user['email'], $user['fullname'], $join_date, $last_login);
			}
			return $list;
		}

		public static function find($id) 
		{
			$db = Db::getInstance();
			$id = intval($id);
			$req = $db->prepare('SELECT * FROM users WHERE userID = :id');
			$req->execute(array('id' => $id));
			$user = $req->fetch();

			$join_date = date("d/m/Y H:i", $user['join_date']);
			$last_login = date("d/m/Y H:i", $user['last_login']);
			
			return new User($user['userID'], $user['username'], $user['email'], $user['fullname'], $join_date, $last_login);
		}
		
		public static function userID()
		{
			
			if(isset($_SESSION['dfm_auth']))
			{
				$authent = explode(":", $_SESSION['dfm_auth']);
				
				$dfm_user = $authent[0];
				$dfm_pwd  = $authent[1];
				
				if(isset($dfm_user) && isset($dfm_pwd))
				{
					$db = Db::getInstance();
					$req = $db->prepare("SELECT userID FROM users WHERE userID = '{$dfm_user}' AND password = '{$dfm_pwd}'");
					$req->execute(array('userID' => $dfm_user));
					
					while($user = $req->fetch()) {
						return $user['userID'];
					}
				}
			}
		}
	}
?>
	