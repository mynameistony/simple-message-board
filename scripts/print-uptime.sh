thisUptime=$(/usr/bin/uptime | grep "up.*,  1 user" -o | sed s/",  1 user"// | sed s/":"/" hours, "/ | sed s/",$"/" minutes"/ | sed s/"up "//)

echo "I've been up for $thisUptime!"
