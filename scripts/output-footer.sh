#!/bin/bash
echo "<p class=\"uptime\" id=\"uptime\">$(scripts/print-uptime.sh)</p>"

echo "<p class=\"time-stamp\" id=\"date\">$(date \"+%A, %B %d %Y%n%r\")</p>"

echo "<p class=\"fortune\" id=\"fortune\">$(/usr/games/fortune)</p>"
