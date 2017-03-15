<?php
class dfm {

	var $version;
	var $release_date;
	var $build;
	var $app_dir;
	
	// DFM MVC WITH LOGIN VERSION
	public function __construct(){
		$this->version = 1.0;
		$this->build = "0.1.0";
		$this->release_date = "";
		$this->app_dir = $_SERVER['DOCUMENT_ROOT'] . "/dfm/tcs_project/";
	}
	
	// Include model classes
	public static function inc_model($file, $dir = "") 
	{	
		$file_location = "models/" . strtolower($file) . ".php";
		

		/* $non_models array
		 * Key = filename & Value = Routing directory 
		 * if including non model classes 
		*/
		$non_models = array("Request" => "controllers");
		
		if( in_array($file, array_keys($non_models)) )
		{
			if( !require_once( $dir . $non_models[$file] . "/" . strtolower($file) . ".php" )) {
				self::system_error( $dir . $non_models[$file] . "/" . strtolower($file) . ".php" . ' does not exist');
			}
		}
	
		else if( !require_once( $dir . $file_location )) {
			self::system_error( $dir . $file_location . ' does not exist');
		}
	}

	// Page title
	public static function page_title() 
	{
		$page = Request::get('controller', Request::TYPE_ALNUM);
		$action = Request::get('action', Request::TYPE_ALNUM);

		$action = ( !empty($action) && $action != "index" ) ? $action : null;
        $title = str_replace("_", " ", ( !empty($page) ) ? $page : "home");
        $title =  ucwords(strtolower($title));  
		
		return $action ? $title .' '.ucwords(strtolower($action)) : $title;			
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