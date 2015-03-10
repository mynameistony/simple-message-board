thisUptime=$(uptime | grep "up.*1 user" -o | grep "^.*[0-9]*:[0-9]*" -o | sed s/":"/" hours, "/ | sed s/"$"/" minutes"/ | sed s/"up "//)

echo "I've been up for $thisUptime!"
