<?php
	class Site
	{

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
		
		public function updateCreatePOST($post)
		{
			return $post;
		}
		
		public function updateEditPost($post)
		{
			return $post;
		}
	}
?>
	