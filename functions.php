<?php
	echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"/styles.css\">";
	echo "<script src=\"/scripts.js\"></script>";

	function check_user_forms($username){
		if(isset($_POST['message-submitted'])){
			$recipient = $_POST['user-selector'];
			$message = $_POST['message-text'];

			#echo shell_exec("bash scripts/send-message.sh $username $recipient \"$message\"")
			echo "Sending '$message' to $recipient";
		}

		if(isset($_POST['post-submitted'])){
			$post = $_POST['post-text'];

			#echo shell_exec("bash scripts/post.sh $user $post");
			echo "Posting '$post'";
		}
	}

	function output_message_form($user){
		echo "<div class=\"message-form\">";
		echo "<form id=\"message\" action=\"home.php\" method=\"post\">";
		echo "<input type=\"text\" name=\"message-text\" placeholder=\"Send a message to:\">";

		echo shell_exec("bash scripts/output-user-selector.sh $user");

		echo "<input type=\"submit\" name=\"message-submitted\" value=\"Send\">";

		echo "</div>";
	}

	function output_current_feed($user){

		if(isset($_POST['feed-selected'])){
			$currentFeed = $_POST['feed-selector'];

			switch ($currentFeed) {
				case "Messages":
					echo "Messages will be here";
					#echo shell_exec("bash scripts/output-message-list.sh $user");
					#View Messages
					
					break;
				
				case 'Feed':
					echo "This will be your feed of other users activity";
					#View all users feed

					break;
				
				case 'Photos':
					echo "This will be other users uploaded photos...shit I still have to add uploads";
					# View photo feed
					break;
				
				default:
					# In Case shit breaks
					echo "Shits broke yo...";
					break;
			}

		}
		else{
			echo "This is your home page...";
		}
	}

	function output_feed_selector(){
		echo "<form id=\"feed-selector-form\" action=\"home.php\" method=\"post\">";
		echo "<select name=\"feed-selector\" id=\"feed-selector\">";
		echo "<option value=\"Feed\">Feed</option>";
		echo "<option value=\"Photos\">Photos</option>";
		echo "<option value=\"Messages\">Messages</option>";
		echo "</select>";
		echo "<input type=\"submit\" name=\"feed-selected\" value=\"Go\"></input>";
		echo "</form>";
	}

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
			return "$username";

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

		if(isset($auth)){
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
		echo "<form id=\"post\" action=\"home.php\" method=\"post\">";
		echo "<input type=\"text\" name=\"post-text\" placeholder=\"Post\">";
		echo "<input type=\"submit\" value=\"Post\" name=\"post-submitted\">";
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
