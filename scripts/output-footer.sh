#!/bin/bash
echo "<p class=\"uptime\" id=\"uptime\">$(scripts/print-uptime.sh)</p>"

storage=$(df -h /home/pi/Storage2 | grep "[0-9]*%" -o | grep "[0-9]")

echo "<p class=\"storage-left\" id=\"storage-left\">$storage of storage used</p>"

echo "<p class=\"time-stamp\" id=\"date\">$(date '+%A, %B %d %Y%n%r')</p>"

echo "<p class=\"fortune\" id=\"fortune\">$(/usr/games/fortune)</p>"
