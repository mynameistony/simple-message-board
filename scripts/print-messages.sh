#!/bin/bash

if [ $# -ne 2 ]
then
	echo -n "Fail"
	exit 1
else
	cat ../users/$1/messages/$2
fi
