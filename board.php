<head>
<link rel="stylesheet" type="text/css" href="/styles.css">
<script src="/scripts.js"></script>
</head>		
<body>
<center>
<?php

	require 'functions.php';

	output_header("My website", "This is a simple message board");

	output_post_form();

	check_for_user_post();

	output_board();

?>
</center>
</body>
