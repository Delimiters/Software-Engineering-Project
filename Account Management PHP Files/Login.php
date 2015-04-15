<?php

$_lines = file("users.txt");
$_signal = 0;

if($_REQUEST["username"]!="" && $_REQUEST["password"]!="")
{
	foreach($_lines as $value)
	{
		if(strpos($value, $_REQUEST["username"]) === 0)
		{
			// Username Found
			$_signal = 1;
		}
	}
	if( $_signal == 1 )
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
	else
	{
		// Username Not Found
		echo "Username or Password Incorrect";
	}
}
else
{
	// Username or Password is Blank
	echo "Please fill out all form entries";
}

?>