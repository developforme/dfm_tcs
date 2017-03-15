<?php
class Project {
	
	var $project_name;
	var $project_dir;
	var $version;
	var $release_date;
	var $build;
	
	// PROJECT CONFIGURATION
	public function __construct()
	{
		$this->project_name = "TCS";
		$this->project_dir = "tcs";
		$this->version = 1.0;
		$this->build = "0.1.0";
		$this->release_date = "";
	}
	
}
?>