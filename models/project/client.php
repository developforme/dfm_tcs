<?php
	class Client
	{		
		public function getClientName( $id )
		{
			$db = db::getInstance();
			$id = intval($id);
			$req = $db->prepare('SELECT name FROM ea_services WHERE id = :id');
			$req->execute(array('id' => $id));
			$client = $req->fetch();

			return $client;
		}
	
		public function updateReadData($data)
		{
			return $data;
		}
	
		public function updateCreatePOST($post)
		{
			return $post;
		}
		
		public function updateEditPost($id, $post)
		{
			return $post;
		}
	}
?>
	