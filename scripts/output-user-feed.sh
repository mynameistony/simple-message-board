#!/bin/bash

if [ $# -eq 1 ]
then
	cat ../users/$1/feed
else
	cat ../feed
fi