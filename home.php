<head>
</head>		
<body>
<center>
<?php
	require 'functions.php';

	$username = validate_user();

	if($username != "Fail"){

		output_header("Welcome $username", "This is $username's home");

		if($username == "tony"){
			echo "Admin Controls:";
		}
		echo "Todo: Add user abilities...";

	}
	else{
		echo "<h2>That username/password combo is invalid, perhaps you should <a href=\"/login.php\">register</a> first</h2>";
	}
?>
</center>
</body>