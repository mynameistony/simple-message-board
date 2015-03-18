<?php
	require 'functions.php';

	output_header("Set the LED strip in my room!", "LED strip");

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


	
	if(isset($_POST['pulse'])){
		$toSend = "M1". $_POST['pulse-color'];
		shell_exec("bash scripts/send-strip.sh \"$toSend\"");
	}
	if(isset($_POST['off'])){
		$toSend = "#000000#000000#000000#000000#000000#000000#000000#000000#000000#000000";
		shell_exec("bash scripts/send-strip.sh \"$toSend\"");
	}
	else
	if(isset($_POST['on'])){
		$toSend = "#ffffff#ffffff#ffffff#ffffff#ffffff#ffffff#ffffff#ffffff#ffffff#ffffff";
		shell_exec("bash scripts/send-strip.sh \"$toSend\"");
	}
	else
	if(isset($_POST['rainbow'])){
		$toSend = "M2";
		shell_exec("bash scripts/send-strip.sh \"$toSend\"");
	}
	else
	if(isset($_POST['send'])){
		$toSend = "";

		for($i = 0; $i < 10; $i++){
			$color = $_POST["LED$i"];
			switch($color){
				case "red":
					$colorCode = "#ff0000";
				break;
                                case "green":
                                        $colorCode = "#0000ff";
                                break;

                                case "blue":
                                        $colorCode = "#00ff00";
                                break;

                                case "cyan":
                                        $colorCode = "#000f0f";
                                break;

                                case "magenta":
                                        $colorCode = "#0f0f00";
                                break;

                                case "yellow":
                                        $colorCode = "#0f000f";
                                break;
                                case "white":
                                        $colorCode = "#ffffff";
                                break;
                                case "off":
                                        $colorCode = "#000000";
                                break;
                                default:
                                        $colorCode = "#010101";
                                break;
			}
			$toSend .= $colorCode;
		}

		shell_exec("bash scripts/send-strip.sh \"$toSend\"");	
	}
	else
	if(isset($_POST['custom-send'])){
		$toSend = "";

		for($i = 0; $i < 10; $i++){
			$color = $_POST["customLED$i"];

			if($color == ""){
				$color = "000000";
			}

			$color = "#$color";
			$toSend .= "$color";
		}

		shell_exec("bash scripts/send-strip.sh \"$toSend\"");

	}
	#echo "$toSend";

?>

<p>
Pulse Color
<br>
<form action="led.php" method="post">
<select name="pulse-color">
	<option value="ff">Green</option>
	<option value="ff00">Blue</option>
	<option value="ff0000">Red</option>
</select>
<input name="pulse" type="submit" value="Go">
</form>
</p>
<br><br>
<p><div><a class="button" href="LED.html">Find out more!</a></div></p>
