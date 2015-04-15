<?php

$_myFile = fopen("users.txt", "a+");
$_lines = file("users.txt");

$indexcounter = 0;
foreach($_lines as $value)
{
	if(strpos($value, $_REQUEST["username"]) !== FALSE)
	{
		$_AccountInfo = explode(";", $value);
		if($_AccountInfo[1] == $_REQUEST["password"])
		{
			// Account Sucessfully Deleted
			$_lines[$indexcounter] = "";
		}
		else
		{
			// Password Incorrect
			echo "Password Incorrect";
		}
	}
	$indexcounter = $indexcounter + 1;
}

// Put leftover accounts back into datafile
file_put_contents("users.txt", implode("", $_lines));

?>