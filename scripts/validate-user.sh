if [ $# -ne 2 ]
	then
	echo -n "Fail"
	exit 1

else

	check=$(cat .htpasswd | grep "^$1:$2" | wc -l)

	if [ $check -eq "1" ]
		then
		echo -n "Ok"
		exit 0
	else
		echo -n "Fail"
		exit 1
	fi
fi