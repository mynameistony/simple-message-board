if [ $# -ne 1 ]
	then
	echo -n "Not right arguments"
	exit 1
else
	video_code=$(echo $1 | grep "\?v=[-0-9a-zA-Z_]*" -o | sed s/"\?v="//)

	cd ydl/

	youtube-dl -f 5 "https://www.youtube.com/watch?v=$video_code"

	if [ $? -eq 0 ]
		then
		title=$(youtube-dl -e "https://www.youtube.com/watch?v=$video_code" 2> /dev/null)
		echo "<p>Still working on making it convert to mp3s...</p>"
		echo "<p><a href=\"/ydl/$video_code.flv\">$title</a></p>"

		soundconverter -q -d -b -m mp3 -s .mp3 "$video_code.m4a" 2> /dev/null
		if [ $? -eq 0 ]
			then

			echo "<p>a href=\"/ydl/$video_code.mp3\">Get it here</a></p>"

		else
			echo "Failed to convert to mp3"
		fi
	else
		echo "Download failed...try another video"
	fi

	exit 0
fi
