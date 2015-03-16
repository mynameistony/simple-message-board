#!/bin/bash

TIMESTAMP=$(date "+%a %D %r")
if [ $# -lt 3 ]
then
	echo -n "Fail"
	exit 1
else
	echo "<div class=\"message\">" >> ../users/$1/messages/$2
	echo "<div class=\"message\">" >> ../users/$2/messages/$1

	echo "<div class=\"timestamp\">$TIMESTAMP</div>" >> ../users/$1/messages/$2
	echo "<div class=\"timestamp\">$TIMESTAMP</div>" >> ../users/$2/messages/$1

    echo "<div class=\"message-content\">$1: $3</div></div>" >> ../users/$1/messages/$2 
	echo "<div class=\"message-content\">$1: $3</div></div>" >> ../users/$2/messages/$1

fi
