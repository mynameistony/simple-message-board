<head>
</head>		
<body>
<center>
<?php
	require 'functions.php';

	require_login();

	$username = $_SERVER['PHP_AUTH_USER'];
	$password = $_SERVER['PHP_AUTH_PW'];

	$status = validate_user($username,$password);

	if($status == "Fail"){
		output_header("You have to login!","You're not allowed in here!");
		unset($_SERVER['PHP_AUTH_USER']);
		unset($_SERVER['PHP_AUTH_PW']);

		echo "WUT";
		exit;
	}
	else{
		output_header("Welcome $username!","This is $username's home");

		check_user_forms($username);

		output_feed_selector();
		output_post_form();
		output_message_form($username);
		output_current_feed($username);
		output_footer();
	}


?>
</center>
</body>
