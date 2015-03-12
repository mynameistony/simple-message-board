<head>
<script src="/ytembed.js"></script>
</head>
<body>
<?php
	require 'functions.php';
	output_header("This a youtube downloader", "So use it");
?>
<p><b>Instructions: </b> Paste a video URL from youtube into the top box then click download<br>Or<br>
Search for a video in the lower box, then right click or long-press on the thumbnail, click Copy Link, then paste in the top box
 and click download.
</p>
<p>
<b>Be very patient after clicking download</b>, my dinky ass server has to download the video first then try to convert it<br>
<b>WAIT FOR THE PAGE TO LOAD AFTER CLICKING DOWNLOAD, DON'T TRY TO REFRESH TO MAKE IT GO FASTER BECAUSE IT WON'T</b>
</p>

<form action="/youtube.php" method="post">
<input type="text" name="url" placeholder="Paste a youtube URL here">
<input type="submit" value="Download" name="download">
</form>

<p>Or</p>

<form onsubmit="ytEmbed.init({'block':'youtubeDivSearch','type':'search','player':'link','q':document.getElementById('ytSearchField').value,'results': 5,'order':'most_relevance'}); return false;">
<input type="text" id="ytSearchField" placeholder="Search for a video">
<input type="submit" value="Search">
</form>

<div style="width:50%;" id="youtubeDivSearch"></div>

<?php
	if(isset($_POST['download'])){
		$url = $_POST['url'];
		echo shell_exec("bash scripts/ydl.sh $url");
	}
?>

</body>
