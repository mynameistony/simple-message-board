#!/bin/bash
if [ $# -lt 2 ]
then
	echo -n "Fail"
	exit 1
else
	post=$(echo "$@" | sed s/"^$1 "//)
	TIME="$(date "+%A, %D at %I:%M %p")"

	cat ../users/$1/feed > ../users/$1/feed.tmp

	echo -n "<div class=\"post\">" > ../users/$1/feed
	echo -n "<div class=\"timestamp\">$TIME</div>" >> ../users/$1/feed
	echo -n "<div class=\"username\">$1</div>" >> ../users/$1/feed
	echo -n "<div class=\"post-content\">$post</div>" >> ../users/$1/feed
	echo -n "</div>" >> ../users/$1/feed

	cat ../feed > ../feed.tmp

	cat ../users/$1/feed > ../feed
	
	cat ../feed.tmp >> ../feed

	cat ../users/$1/feed.tmp >> ../users/$1/feed

	echo -n "Ok"
	exit 0
fi

