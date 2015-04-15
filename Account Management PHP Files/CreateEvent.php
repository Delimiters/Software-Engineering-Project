<?php

$_EventsFile = fopen("events.txt", "a+");
$_EventsLines = file("events.txt");
$_AccountsFile = fopen("users.txt", "a+");
$_AccountsLines = file("users.txt");
$_signal = 0;

if($_REQUEST["dateandtime"]!="" && $_REQUEST["location"]!="" && $_REQUEST["friends"])
{
	foreach($_EventsLines as $value)
	{
		if(strpos($value, $_REQUEST["username"]) === 0)
		{
			// User Already Has Event
			echo "User already has event pending";
			$_signal = 1;
		}
	}
	if( $_signal == 0 )
	{
		// Event sucessfully writen to the datafile
		$friendcounter = 1; $indexcounter = 0;
		$friends = explode(";", $_REQUEST["friends"]);
		foreach($friends as $friendusername)
		{
			$indexcounter = 0;
			foreach($_AccountsLines as $value)
			{
				if( strpos($value, $friendusername)
				{
					$_AccountsLines[$indexcounter] = str_replace("\n", "", $_AccountsLines[$indexcounter]).$_REQUEST["username"].";".$_REQUEST["dateandtime"].";".$_REQUEST["location"].";\n";
				}
				$indexcounter = $indexcounter + 1;
			}
			$friendcounter = $friendcounter + 1;
		}
		
		file_put_contents("users.txt", implode("", $_AccountsLines));
		
		fwrite($_EventsFile, $_REQUEST["username"].";".$_REQUEST["dateandtime"].";".$_REQUEST["location"].";".$friendcounter.";");
	}
}
else
{
	// One of the Entries Is Blank
	echo "Please fill out Date-and-Time, Location, and at least one Friend";
}

?>