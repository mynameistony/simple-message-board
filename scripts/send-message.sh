#!/bin/bash

TIMESTAMP=$(date "+%a %D %r")
if [ $# -lt 3 ]
then
	echo -n "Fail"
	exit 1
else
	echo "<div class=\"message\" id=\"$TIMESTAMP\"><p>[$TIMESTAMP] $1: $3</p></div>" >> ../users/$2/messages/$1
    echo "<div class=\"message\" id=\"$TIMESTAMP\"><p>[$TIMESTAMP] $1: $3</p></div>" >> ../users/$1/messages/$2 
fi
