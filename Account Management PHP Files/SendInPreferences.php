<?php

$_EventsFile = fopen("events.txt", "a+");
$_EventsLines = file("events.txt");
$_RestaurantsFile = fopen("restaurants.txt", "a+");
$_RestaurantsLines = file("restaurants.txt");

$indexcounter = 0;
foreach($_EventsLines as $value)
{
	if(strpos($value, $_REQUEST["inviter"]) === 0)
	{
		$_EventInfo = explode(";", $_EventsLines[$indexcounter]);
		
		if($_REQUEST["preferences"] == 0)
		{
			$_EventInfo[3] = $_EventInfo[3] - 1;
			$_EventsLines[$indexcounter] = implode(";", $_EventInfo);
		}
		else
			$_EventsLines[$indexcounter] = str_replace("\n", "", $_EventsLines[$indexcounter]).$_REQUEST["username"].";".$_REQUEST["preferences"].";\n";
		
		//************************************************************************************************************************************************************************************
		$friendcount = $_EventInfo[3];
		if( $_EventInfo[(2 * $friendcount + 4)] != NULL )
		{
			$x = 5; $totalpreferences = 0;
			while( $_EventInfo[$x] != NULL )
			{
				$totalpreferences = $totalpreferences + $_EventInfo[$x];
				$x = $x + 2;
			}
			$person = 4; $personcounter = 0;
			while( $_EventInfo[$person] != NULL && $_EventInfo[$person] != "\n" )
			{
				$person = $person + 2
				$personcounter = $personcounter + 1;
			}
			fwrite($_RestaurantsFile, $_EventInfo[0].";".$_EventInfo[1].";".$_EventInfo[2].";".$totalpreferences.";0;".$personcounter.";");
			$person = 4;
			while( $_EventInfo[$person] != NULL && $_EventInfo[$person] != "\n" )
			{
				fwrite($_RestaurantsFile, $_EventInfo[$person].";");
				$person = $person + 2;
			}
			fwrite($_RestaurantsFile, "\n");
			$_EventsLines[$indexcounter] = "";
		}
		//************************************************************************************************************************************************************************************
	}
	$indexcounter = $indexcounter + 1;
}

file_put_contents("events.txt", implode("", $_EventsLines));

?>