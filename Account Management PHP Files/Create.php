<?php

$_Accounts = file_get_contents('users.txt');
$_myFile = fopen("users.txt", "a+");
$_lines = file("users.txt");

if($_REQUEST["username"]!="" && $_REQUEST["password"]!="" && $_REQUEST["firstname"]!="" && $_REQUEST["lastname"]!="" && $_REQUEST["hometown"]!="")
{
	if(strpos($_Accounts, $_REQUEST["username"]) !== FALSE)
	{
		// Username Is Already Taken
		echo "Username is already taken";
	}
	else
	{
		fwrite($_myFile, $_REQUEST["username"].";".$_REQUEST["password"].";".$_REQUEST["firstname"].";".$_REQUEST["lastname"].";".$_REQUEST["hometown"]."\n");
	}
}
else
{
	// One of the Entries Is Blank
	echo "Please fill out all form entries";
}

?>