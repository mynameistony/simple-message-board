#!/bin/bash

if [ $# -ne 1 ]
then
	echo -n "Fail"
	exit 1
else
	./send-serial.py $1
	exit 0
fi
