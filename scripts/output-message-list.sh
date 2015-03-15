#!/bin/bash

if [ $# -ne 1 ]
	then
	echo -n "Fail"
	exit 1

else
	for name in $(ls ../users/$1/messages)
	do
		echo "$name"
	done
	echo "FUCK"
	exit 0
fi
	