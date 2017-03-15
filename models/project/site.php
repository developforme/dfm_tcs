<?php
	class Site
	{
		public $name;
		public $address;
		public $telephone;
		public $email;

		public function __construct($name, $address, $telephone, $email) 
		{
			$this->name      = $name;
			$this->address   = $address;
			$this->telephone = $telephone;
			$this->email     = $email;

		}

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
	}
?>
	