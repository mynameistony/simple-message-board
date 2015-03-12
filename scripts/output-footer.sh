#!/bin/bash
echo "<p id=\"uptime\">$(scripts/print-uptime.sh)</p>"

date

echo "<p id=\"fortune\">$(/usr/games/fortune)</p>"
