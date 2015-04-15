<?php

$_EventsFile = fopen("events.txt", "a+");
$_EventsLines = file("events.txt");
$_AccountsFile = fopen("users.txt", "a+");
$_AccountsLines = file("users.txt");
$_RestaurantsFile = fopen("restaurants.txt", "a+");
$_RestaurantsLines = file("restaurants.txt");
$_EmptySignal = 0;

$indexcounter = 0;
foreach($_AccountsLines as $value)
{
	if(strpos($value, $_REQUEST["username"]) === 0)
	{
		$_AccountInfo = explode(";", $value);
		if( $_AccountInfo[5] != NULL )
		{
			$x = 5; $y = 0; $arr = array();
			while($_AccountInfo[$x] != NULL && $_AccountInfo[$x] != "\n")
			{
				$arr[$y] = array('inviter' => $_AccountInfo[$x], 'dateandtime' => $_AccountInfo[$x+1], 'location' => $_AccountInfo[$x+2]);
				$x = $x + 3;
				$y = $y + 1;
			}
			echo json_encode($arr);
			
			$_AccountsLines[$indexcounter] = $_AccountInfo[0].";".$_AccountInfo[1].";".$_AccountInfo[2].";".$_AccountInfo[3].";".$_AccountInfo[4].";\n";
		}
		else
		{
			$_EmptySignal = 1;
		}
	}
	$indexcounter = $indexcounter + 1;
}
file_put_contents("users.txt", implode("", $_AccountsLines));

$indexcounter = 0;
foreach($_RestaurantsLines as $value)
{
	if(strpos($value, $_REQUEST["username"]) !== FALSE)
	{
		$_RestaurantInfo = explode(";", $value);
		$arr = array('inviter' => $_RestaurantInfo[0], 'dateandtime' => $_RestaurantInfo[1], 'location' => $_RestaurantInfo[2], 'totalpreferences' => $_RestaurantInfo[3]);
		echo json_encode($arr);
		$_EmptySignal = 0;
	}
	$indexcounter = $indexcounter + 1;
}

if( $_EmptySignal == 1)
	echo "No event invites at this time";

?>