<head>
	<center>
		<h1>Welcome to <i>very</i> simple messageboard</h1>
	
		<form id="post" action="board.php" method="post">
		<input type="text" name="post-text" placeholder="Post">
		<input type="text" name="post-username" placeholder="Name (Optional)">
		<input type="submit" value="Post" name="submitted">
		</form>
		
<?php
	if($_POST['post-text'] != ""){
		$newPost=$_POST['post-text'];

		if($_POST['post-username'] != ""){
			$username=$_POST['post-username'];
			if($username!="admin")
				echo shell_exec("bash scripts/userpost.sh $username $newPost");
			else
				echo "You can't do that!";
		}
		else{

			echo shell_exec("bash scripts/post.sh $newPost");
		}
	}
	else{

	}


	echo shell_exec("bash scripts/output-board.sh");
?>

	</center>
