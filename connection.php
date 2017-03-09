<?php
class Db 
{
    private static $instance = NULL;

	private function __construct() {}

	private function __clone() {}

	public static function getInstance() 
	{
		try
		{
			$db_host = "localhost";
			$db_name = "dfm";
			$db_user = "dfm";
			$db_pass = "542769";
			
			if (!isset(self::$instance)) 
			{
				$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
				self::$instance = new PDO("mysql:host={$db_host};dbname={$db_name}", $db_user, $db_pass, $pdo_options);
			}
			
			return self::$instance;
		}
		catch(PDOException $err)
		{
            $err->getMessage() . "<br/>";
            file_put_contents('error.log',$err, FILE_APPEND);   
            return $err->getMessage();
		}
	}
}
?>

