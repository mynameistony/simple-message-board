<?php
	require 'functions.php';

	output_header("This is a test page", "This page is for testing");

	$colors = array("off","red", "green", "blue", "cyan", "magenta", "yellow", "white"); 

	echo "<form action=\"led.php\" method=\"post\">";
	for ($i = 0; $i < 10; $i++){
		echo "LED #$i: ";
		echo "<select name=\"LED$i\">";
		foreach($colors as $color){
			echo "<option value=\"$color\">$color</option>";
		}
		echo "</select>";
		echo "<br>";
	}

	echo "<input type=\"submit\" name=\"send\" value=\"Send to strip\">";
	echo "</form>";



	if(isset($_POST['send'])){
		$toSend = "xxxxxxxxxx";
		for($i = 0; $i < 10; $i++){
			$color = $_POST["LED$i"];
			$colorCode = substr($color, 0);

			if($colorCode == 'o')
				$colorCode = "x";

			$toSend[$i] = $colorCode;
		}
	}
	#echo "$toSend";
	shell_exec("bash scripts/send-strip.sh $toSend");
?>
