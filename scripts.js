
function validateUsername(){
	var username = document.getElementById("username").value;

	if(username.search("[ $\'\"\;]") > 0){
		document.getElementById("message").innerHTML = "Can't use spaces or these: \$\'\"\;";
		document.getElementById("register").style = "visibility:hidden";
		document.getElementById("register-form").action = "invalid.php";
	}
	else{
		document.getElementById("register").style = "visibility:visible";
		document.getElementById("register-form").action = "login.php";
	}
}

function validatePassword(){
	var pass = document.getElementById("password").value;

	if(pass.search("[ $\'\"\;]") > 0){
		document.getElementById("message").innerHTML = "Can't use spaces or these: \$ \' \"\;";
		document.getElementById("register").style = "visibility:hidden";
		document.getElementById("register-form").action = "invalid.php";		
	}
	else{
		document.getElementById("register").style = "visibility:visible";
		document.getElementById("register-form").action = "login.php";
	}
}