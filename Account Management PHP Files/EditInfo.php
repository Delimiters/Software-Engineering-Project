<?php

$_myFile = fopen("users.txt", "a+");
$_lines = file("users.txt");

// Don't allow user to change username using this file. That would allow a security hole with duplicate usernames.
// Username in the $_REQUEST superglobal should be the value that the app stores FOR the user. The user should not enter it.

if(isset($_REQUEST["password"]) && isset($_REQUEST["firstname"]) && isset($_REQUEST["lastname"]) && isset($_REQUEST["hometown"]))
{
	$indexcounter = 0;
	foreach($_lines as $value)
	{
		if(strpos($value, $_REQUEST["username"]) !== FALSE)
		{
			// Change parameters to their new values
			$_lines[$indexcounter] = $_REQUEST["username"].";".$_REQUEST["password"].";".$_REQUEST["firstname"].";".$_REQUEST["lastname"].";".$_REQUEST["hometown"].";\n";
		}
		$indexcounter = $indexcounter + 1;
	}
	file_put_contents("users.txt", implode("", $_lines));
}
else
{
	// The user tried to change a value to "blank"
	echo "Please enter values for all form entries";
}

?>