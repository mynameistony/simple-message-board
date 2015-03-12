thisUptime=$(/usr/bin/uptime | grep "up.*1[0-9]*:[0-9]*" -o | sed s/":"/" hours, "/ | sed s/"$"/" minutes"/ | sed s/"up "//)

echo "I've been up for $thisUptime!"
