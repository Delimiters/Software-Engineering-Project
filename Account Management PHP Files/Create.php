<?php

$_myFile = fopen("users.txt", "a+");
$_signal = 0;

if($_REQUEST["username"]!="" && $_REQUEST["password"]!="" && $_REQUEST["firstname"]!="" && $_REQUEST["lastname"]!="" && $_REQUEST["hometown"]!="")
{
	foreach($_lines as $value)
	{
		if(strpos($value, $_REQUEST["username"]) === 0)
		{
			// Username already taken
			echo "Username Already Taken";
			$_signal = 1;
		}
	}
	if( $_signal == 0 )
	{
		// Account sucessfully writen to the datafile
		fwrite($_myFile, $_REQUEST["username"].";".$_REQUEST["password"].";".$_REQUEST["firstname"].";".$_REQUEST["lastname"].";".$_REQUEST["hometown"].";\n");
	}
}
else
{
	// One of the Entries Is Blank
	echo "Please fill out all form entries";
}

?>