<?php
	require 'functions.php';

	output_header("This is a test page", "This page is for testing");

	echo shell_exec("bash scripts/send-strip.sh Hi");

	echo "End";
?>
