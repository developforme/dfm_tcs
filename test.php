<?php
			$keys = array(
				"username" => "Username",
				"fullname" => "Full Name",
				"email"    => "Email"
			);
			

$values = array("value1", "value2", "value3");

$value1 = "one";
$value2 = "two";
$value3 = "three";

$output = array_combine($keys, $values);
print_r($output);


foreach($keys as $key)

?>