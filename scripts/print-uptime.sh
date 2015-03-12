thisUptime=$(/usr/bin/uptime | grep "up.*,.*user" -o | sed s/",  .*user$"// | sed s/":"/" hours, "/ | sed s/",$"/" minutes"/ | sed s/"up "//)

echo "I've been up for $thisUptime!"
