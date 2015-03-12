<?php

$_Accounts = file_get_contents('users.txt');
$_myFile = fopen("users.txt", "a+");
$_lines = file("users.txt");

if($_REQUEST["username"]!="" && $_REQUEST["password"]!="")
{
	if(strpos($_Accounts, $_REQUEST["username"]) === FALSE)
	{
		// Username Not Found
		echo "Username or Password Incorrect";
	}
	else
	{
		foreach($_lines as $value)
		{
			if(strpos($value, $_REQUEST["username"]) !== FALSE)
			{
				$_AccountInfo = explode(";", $value);
				if($_AccountInfo[1] == $_REQUEST["password"])
				{
					// Log In Successful
					$arr = array('username' => $_AccountInfo[0], 'password' => $_AccountInfo[1], 'firstname' => $_AccountInfo[2], 'lastname' => $_AccountInfo[3], 'hometown' => $_AccountInfo[4]);
					echo json_encode($arr);
				}
				else
				{
					// Password Incorrect
					echo "Username or Password Incorrect";
				}
			}
		}
	}
}
else
{
	// Username or Password is Blank
	echo "Please fill out all form entries";
}

?>