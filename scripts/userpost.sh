#!/bin/bash
TIME="$(date "+%A, %D at %I:%M %p")"
user=$1

post=$(echo $@ | sed s/$1//)

echo "<div class=\"post\">" >> board.txt
echo "<div class=\"timestamp\">$TIME</div>" >> board.txt
echo "<div class=\"username\">$user</div>" >> board.txt
echo "<div class=\"post-content\">$post</div>" >> board.txt
echo "</div>" >> board.txt
echo "<p><b>$user posted: $post on $TIME</b></p>"



