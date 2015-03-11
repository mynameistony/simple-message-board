<?php
	require 'functions.php';

	echo "<center>";
	output_header("Nice, try", "This is a page for invalid user input");
	echo "<h2>Shame on you</h2>";
	echo "</center>";

	shell_exec("bash scripts/send-strip.sh rrr0000rrr")
?>