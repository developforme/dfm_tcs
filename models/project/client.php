<?php
	class Client
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
			$req = $db->query('SELECT * FROM clients');

			foreach($req->fetchAll() as $client) {
				$list[] = new User($client['name'], $client['address'], $client['telephone'], $client['email']);
			}
			return $list;
		}

		public static function find($id) 
		{
			$db = db::getInstance();
			$id = intval($id);
			$req = $db->prepare('SELECT * FROM clients WHERE clientID = :id');
			$req->execute(array('id' => $id));
			$user = $req->fetch();

			return new User($client['name'], $client['address'], $client['telephone'], $client['email']);
		}
	}
?>
	