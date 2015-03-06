#!/bin/bash

if [ $# -ne 2 ]
	then
	echo -n "Fail"
	exit 1
else

	taken=$(cat .htpasswd | grep "^$1" | wc -l)

	if [ $taken == "0" ]
		then
		echo "$1:$2" >> .htpasswd
		echo -n "Ok"
		exit 0
	else
		echo -n "Taken"
		exit 1
	fi
fi
