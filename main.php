<head>
</head>

<body>
	<center>
		<h1>Welcome to my more interactive site!</h1>
		<p style="padding-bottom:40px">
			<a href="/">Home page</a> |
			<a href="/login.php">Login/Register</a> |
			<a href="http://mynameistony.github.io">My other site</a>
		</p>

		<div><a class="button" href="board.php">Message Board</a></div><br><br>
        <div><a class="button" href="led.php">Set the LED strip in my room!</a></div><br><br>

	<?php
		require 'functions.php';
		#echo shell_exec("bash scripts/print-uptime.sh");
		#shell_exec("bash scripts/send-strip.sh goooooooog");
		output_footer();
	?>
	</center>
</body>
