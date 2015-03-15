#!/bin/bash

if [ $# -lt 3 ]
then
	echo -n "Fail"
	exit 1
else
	echo "<div class=\"message\" id=\"$(date)\">$1: $3" >> ../users/$2/messages/$1
        echo "<div class=\"message\" id=\"$(date)\">$1: $3" >> ../users/$1/messages/$2 

fi
