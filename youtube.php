<head>
<link rel="stylesheet" type="text/css" href="/styles.css">
<script src="/scripts.js"></script>
<script src="/ytembed.js"></script>
</head>
<body>
<?php
	require 'functions.php';
	output_header("This a youtube downloader", "So use it");
?>
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