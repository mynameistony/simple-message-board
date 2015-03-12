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

		echo " or enter a custom value";
		echo "<input type=\"text\" id=\"customLED$i\" name=\"customLED$i\">";

		echo "<br>";
	}

	echo "<p><input type=\"submit\" name=\"send\" value=\"Send to strip\">";

	echo "<input type=\"submit\" name=\"custom-send\" value=\"Send custom\"></p>";

	echo "<input type=\"submit\" name=\"rainbow\" value=\"Rainbow\"> ";
	echo "<input type=\"submit\" name=\"off\" value=\"Off\"> ";
	echo "<input type=\"submit\" name=\"on\" value=\"White\"> ";
	echo "</form>";


	

	if(isset($_POST['off'])){
		$toSend = "#000000#000000#000000#000000#000000#000000#000000#000000#000000#000000";
		shell_exec("bash scripts/send-strip.sh $toSend");
	}
	else
	if(isset($_POST['on'])){
		$toSend = "#ffffff#ffffff#ffffff#ffffff#ffffff#ffffff#ffffff#ffffff#ffffff#ffffff";
		shell_exec("bash scripts/send-strip.sh $toSend");
	}
	else
	if(isset($_POST['rainbow'])){
		$toSend = "#ff0000#ff0000#ff0000#ff0000#ff0000#ff0000#ff0000#ff0000#ff0000#ff0000";
		shell_exec("bash scripts/send-strip.sh $toSend");
	}
	else
	if(isset($_POST['send'])){
		$toSend = "xxxxxxxxxx";

		for($i = 0; $i < 10; $i++){
			$color = $_POST["LED$i"];
			$colorCode = substr($color, 0);

			if($colorCode == 'o')
				$colorCode = "x";

			$toSend[$i] = $colorCode;
		}

		shell_exec("bash scripts/send-strip.sh $toSend");	
	}else
	if(isset($_POST['custom-send'])){

		for($i = 0; $i < 10; $i++){
			$color = $_POST["customLED$i"];

			if($color == "")
				$color = "000000";

			$color = "#$color";
			$toSend .= "$color";
		}

		shell_exec("bash scripts/send-strip.sh $toSend");

	}
	#echo "$toSend";

?>
<br><br>
<p><div><a class="button" href="LED.html">Find out more!</a></div></p>
