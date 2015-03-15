#!/bin/bash

if [ $# -ne 1 ]
	then
	echo -n "Fail"
	exit 1

else
	echo "<div class=\"message-selector\">"
	echo "<form action=\"home.php\" method=\"post\">"
	echo "<select name=\"friend-selector\">"
	for name in $(ls ../users/$1/messages)
	do
		echo "<option value=\"$name\">$name</option>"

	done
	echo "</select>"
	echo "<input name=\"message-selected\" type=\"submit\" value=\"Go\">"
	echo "</form></div>"
	exit 0
fi
	