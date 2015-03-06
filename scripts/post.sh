#!/bin/bash
if [ $# -lt 1 ]
then
	echo -n "No content"
	exit 1
else


	TIME="$(date "+%A, %D at %I:%M %p")"
	echo "<div class=\"post\">" >> board.txt
	echo "<div class=\"timestamp\">$TIME</div>" >> board.txt
	echo "<div class=\"username\">Anonymous</div>" >> board.txt
	echo "<div class=\"post-content\">$@</div>" >> board.txt
	echo "</div>" >> board.txt

	echo -n "Ok"
fi

