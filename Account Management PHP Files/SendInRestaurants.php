<?php

$_EventsFile = fopen("events.txt", "a+");
$_EventsLines = file("events.txt");
$_AccountsFile = fopen("users.txt", "a+");
$_AccountsLines = file("users.txt");
$_RestaurantsFile = fopen("restaurants.txt", "a+");
$_RestaurantsLines = file("restaurants.txt");

$indexcounter = 0;
foreach($_RestaurantsLines as $value)
{
	if(strpos($value, $_REQUEST["inviter"]) === 0)
	{
		
	}
}

?>