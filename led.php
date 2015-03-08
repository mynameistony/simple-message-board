<?php
	require 'functions.php';

	output_header("This is a test page", "This page is for testing");

	$colors = array("off","red", "green", "blue", "cyan", "magenta", "yellow", "white"); 

	echo "<form action=\"led.php\" method=\"post\">";
	for ($i = 0; $i < 10; $i++){
		echo "<b id=\"LED$i-label\">LED #$i</b>: ";
		echo "<select onchange=\"setColor()\" name=\"LED$i\" id=\"LED$i-selector\">";
		foreach($colors as $color){
			echo "<option value=\"$color\">$color</option>";
		}
		echo "</select>";
		echo "<br>";
	}

	echo "<p><input type=\"submit\" name=\"send\" value=\"Send to strip\"></p>";
	echo "<input type=\"submit\" name=\"rainbow\" value=\"Rainbow\"> ";
	echo "<input type=\"submit\" name=\"off\" value=\"Off\"> ";
	echo "<input type=\"submit\" name=\"on\" value=\"White\"> ";
	echo "</form>";


	$toSend = "xxxxxxxxxx";

	if(isset($_POST['off'])){
		$toSend = "oooooooooo";
		shell_exec("bash scripts/send-strip.sh $toSend");
	}
	else
	if(isset($_POST['on'])){
		$toSend = "wwwwwwwwww";
		shell_exec("bash scripts/send-strip.sh $toSend");
	}
	else
	if(isset($_POST['rainbow'])){
		$toSend = "wwrygcbmww";
		shell_exec("bash scripts/send-strip.sh $toSend");
	}
	else
	if(isset($_POST['send'])){
			
		for($i = 0; $i < 10; $i++){
			$color = $_POST["LED$i"];
			$colorCode = substr($color, 0);

			if($colorCode == 'o')
				$colorCode = "x";

			$toSend[$i] = $colorCode;
		}

		shell_exec("bash scripts/send-strip.sh $toSend");	
	}
	#echo "$toSend";
	
?>
<br><br>
<p><div><a class="button" href="LED.html">Find out more!</a></div></p>
