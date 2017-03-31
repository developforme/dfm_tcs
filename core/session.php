<?php
class Session {
	
	static $session_duration = 24;
	
	public static function session_duration()
	{
		return self::$session_duration;
	}
}
?>