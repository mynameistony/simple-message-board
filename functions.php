<?php
	echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"/styles.css\">";
	echo "<script src=\"/scripts.js\"></script>";
	function output_footer(){
		echo shell_exec("bash scripts/output-footer.sh");
	}
	function post_message($message){

	}

	function user_post_message($username, $message){

	}

	function validate_user($username,$password){
		$status = shell_exec("bash scripts/validate-user.sh $username $password");

		if($status == "Ok"){
			$_SERVER['PHP_AUTH_USER'] = $username;
			$_SERVER['PHP_AUTH_PW'] = $password;
			return "$user";

		}
		else
			return "Fail";
	}

	function create_user($newName,$newPass){

		$status=shell_exec("bash scripts/add-user.sh $newName $newPass");

		switch ($status) {
			case "Ok":
				echo "<p>Welcome, $newName.<br>Your password is: $newPass</p>";
				break;
			case "Taken":
				echo "<p>Oops, that name is taken already, try another.</p>";
				break;

			default:
				echo "<p>Uh-oh, something went wrong, try again.</p>";
				break;
		}
	}

	function output_board(){
		echo shell_exec("bash scripts/output-board.sh");
	}

	function require_login(){
		if(!isset($_SERVER['PHP_AUTH_USER'])){
			header('WWW-Authenticate: Basic realm="Login"');
			header('HTTP/1.0 401 Unauthorized');
			unset($_SERVER['PHP_AUTH_USER']);
			unset($_SERVER['PHP_AUTH_PW']);
			output_header("You have to login to view this page", "You're not allow to be here");
		}
	}

	function output_header($title,$heading,$auth){

		if($auth == "Yes"){
			require_login();
		}

		echo "<title id=\"title\">$title</title>";
		echo "<div class=\"header\" id=\"header\">";
		echo "<h1 id=\"heading\" class=\"heading\">$heading</h1>";
		echo "<p id=\"nav-links\" class=\"nav-links\">";
		echo "<a href=\"/\">Home page</a> | ";
		echo "<a href=\"http://mynameistony.github.io\">My other site</a>";
		echo "</p>";
		echo "</div>";


	}

	function check_register(){

		if(isset($_POST['register'])) {
			if(isset($_POST['username-register'])) {
				if(isset($_POST['password-register'])) {

					echo "Registering...";

					$newUserName = sanitize($_POST['username-register']);

					$newUserPass = sanitize($_POST['password-register']);

					create_user($newUserName,$newUserPass);
				}
			}

		}
	}

	function check_for_user_post(){
		if($_POST['post-text'] != ""){
				$newPost=$_POST['post-text'];

				$newPost = sanitize($newPost);

				if($_POST['post-username'] != ""){
					$username=$_POST['post-username'];
					

					if($username!="admin")
						echo shell_exec("bash scripts/userpost.sh $username $newPost");
					else
						echo "You can't do that!";
				}
				else{

					$response = shell_exec("bash scripts/post.sh $newPost");

					if($response == "Ok"){
						echo "<p id=valid-post-response class=valid-post-response>You posted: $newPost</p>";
					}

					else{
						echo "<p id=invalid-post-response class=invalid-post-response>Post failed, did you use weird characters?</p>";
					}
				}
			}
	}

	function output_post_form(){
		echo "<div id=\"post-form\" class=\"post-form\">";
		echo "<form id=\"post\" action=\"board.php\" method=\"post\">";
		echo "<input type=\"text\" name=\"post-text\" placeholder=\"Post\">";
		echo "<input type=\"text\" name=\"post-username\" placeholder=\"Name (Optional)\">";
		echo "<input type=\"submit\" value=\"Post\" name=\"submitted\">";
		echo "</form>";
		echo "</div>";
	}

	function sanitize($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		$data = str_replace('"', "\"", $data);
		$data = str_replace("'", "\'", $data);
		$data = str_replace(" ", "\ ", $data);
		return $data;
	}	
?>
