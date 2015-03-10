function setColor(){
	for (var i = 0; i < 10; i++) {
		var thisLEDselector = "LED" + i + "-selector";
		var thisLEDlabel = "LED" + i + "-label";
		var thisLEDcolor = "color:" + document.getElementById(thisLEDselector).value;
		document.getElementById(thisLEDlabel).style = thisLEDcolor;
	}
}

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

function checkInput(){

	var answers = ["will","u","go","to","prom","width","mi"];
	var message = "";
	var numCorrect = 0;

	for(i = 0; i < 7; i++){
		thisInput = "input" + i;
		thisPrompt = "prompt" + i;
		//alert(thisInput);

		thisValue = document.getElementById(thisInput).value;
		//alert(thisValue);

		if(thisValue == answers[i]){
			numCorrect++;
			message = message + " " + thisValue;

			if(numCorrect == 7){
				message+="?";
			}

			document.getElementById("answer").innerHTML = message;
			document.getElementById(thisPrompt).style = "color:green";
		}
		else
			document.getElementById(thisPrompt).style = "color:red";

		
	}

}