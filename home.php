<head>
</head>		
<body>
<center>
<?php
	require 'functions.php';

	if(isset($_POST['username-login'])){

		if(isset($_POST['password-login'])){
			$username = $_POST['username-login'];
			$password = $_POST['password-login'];

			$status = validate_user($username, $password);

			if($status == "Fail"){
				output_header("You have to login!","You're not allowed in here!");
				exit;
			}
			else{
				output_header("Welcome $username!","This is $username's home");
			}
		}
	}
	else{

		require_login();

		$username = $_SERVER['PHP_AUTH_USER'];
		$password = $_SERVER['PHP_AUTH_PW'];

		$status = validate_user($username,$password);

		if($status == "Fail"){
			output_header("You have to login!","You're not allowed in here!");
			unset($_SERVER['PHP_AUTH_USER']);
			unset($_SERVER['PHP_AUTH_PW']);
                        exit;
		}
		else{
			output_header("Welcome $username!","This is $username's home");
		}
	}

?>
</center>
</body>
