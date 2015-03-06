#!/usr/bin/python
import serial
import sys

ser = serial.Serial("/dev/ttyAMA0", 9600)
ser.open()
send = sys.argv[1]
ser.write(send)
ser.close()

print "Ok"
