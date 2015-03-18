#!/bin/bash

echo $@

if [ $# -ne 1 ]
then
	echo -n "Fail"
	exit 1
else
	scripts/send-serial.py $1
	exit 0
fi
