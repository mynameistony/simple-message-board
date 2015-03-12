<head>
</head>		
<body>
<center>

<?php
	require 'functions.php';

	output_header("Login or Register", "Login or create an account");

	check_register();

?>
<form action="home.php" method="post">
<input type="text" name="username-login" placeholder="Username">
<input type="password" name="password-login" placeholder="Password">
<input type="submit" name="login" value="Login">
</form>

<form id="register-form" action="login.php" method="post">
<input onchange="validateUsername()" id="username" type="text" name="username-register" placeholder="New Username">
<input onchange="validatePassword()" id="password" type="password" name="password-register" placeholder="New Password">
<input type="submit" id="register" name="register" value="Register">
</form>
<p id="message"></p>

</center>
</body>