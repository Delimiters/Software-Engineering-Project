<?php

$_Accounts = file_get_contents('users.txt');
$_myFile = fopen("users.txt", "a+");
$_lines = file("users.txt");

$indexcounter = 0;
foreach($_lines as $value)
{
	if(strpos($value, $_REQUEST["username"]) !== FALSE)
	{
		$_lines[$indexcounter] = "";
	}
	$indexcounter = $indexcounter + 1;
}
file_put_contents("users.txt", implode("", $_lines));

?>