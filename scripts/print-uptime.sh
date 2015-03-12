thisUptime=$(/usr/bin/uptime | grep "up.*,.*user" -o | sed s/"  [0-9]* user$"// | sed s/",$"/" minutes"/ | sed s/":"/" hours, "/ | sed s/"up "//)

echo "I've been up for $thisUptime!"
