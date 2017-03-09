<?php
class dfm {

	var $version;
	var $release_date;
	var $build;
	
	// DFM MVC WITH LOGIN VERSION
	public function __construct(){
		$this->version = 1.0;
		$this->build = "0.1.0";
		$this->release_date = "";
	}
	
	// Include model classes
	public static function inc_model($file) 
	{	
		$file_location = "models/" . strtolower($file) . ".php";
	
		if( !require_once( $file_location )) {
			self::system_error($file_location . ' does not exist');
		}
	}
	
	// Include core classes
	public static function inc_core($file) 
	{	
		$file_location = "core/" . strtolower($file) . ".php";
	
		if( !require_once( $file_location )) {
			self::system_error($file_location . ' does not exist');
		}
	}
	
	// Redirect 
    public static function redirect($url, $info = null, $time=0) 
	{
		$url = (isset($_SERVER['HTTP_REFERER']) AND $url == "back") ? $_SERVER['HTTP_REFERER'] : $url;
	    echo "<meta http-equiv='refresh' content='{$time};URL={$url}' /> {$info}";
    }
	
	// Output system error
	public static function system_error($err)
	{
		file_put_contents('error.log',$err, FILE_APPEND);   
		throw new Exception ($err);
		return "<div class=''>System error: {$err}</div>";
	}
}
?>