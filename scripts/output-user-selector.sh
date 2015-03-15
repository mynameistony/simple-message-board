
echo "<select name=\"user-selector\">"
for user in $(ls ../users)
do
	if [ "$user" != "$1" ]
		then
		echo "<option value=\"$user\">$user</option>"
	fi
done
echo "</select>"