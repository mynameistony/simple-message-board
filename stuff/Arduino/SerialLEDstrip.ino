/*

*/

#include "stuff.h" //Include my LED Strip class for ease
#include <SoftwareSerial.h> //Include Ser...wait mine doesn't even use the Software Serial...you should though,
//See below

Strip strip; //Create a strip object

SoftwareSerial ser(6,7); // (Rx Pin, Tx Pin) Creates a software serial connection to the pi.
//Our setup is one-way so the second number doesn't matter (though the pin will be unusable)

void setup(){ // Runs once to initialize things

  //Serial.begin(9600); // Start communication with the Serial port for debugging
  ser.begin(9600); // Start communication with the Raspberry Pi serial port 
}

void loop(){ // Run forever and ever

  if(ser.available()){ // If we receive something...

    String rx = ser.readStringUntil('\n'); // Wait for the end and read it as string of characters

    // It will be a 10 character string, with each character being the first letter of what color that LED should
    // e.g: rwbrwbrwbo -> will red, white, blue, red, white, blue...

       for(int i = 0; i < 10; i++){ //Loop through the string setting each LED

          switch(rx[i]){  //Check each letter of the string and set the strip accordingly
            case 'r':
              strip.strip[i] = 0xff0000; // Red
            break;
            case 'g':
              strip.strip[i] = 0x0000ff; // Green
            break;
            case 'b':
              strip.strip[i] = 0x00ff00; // Blue
            break;
            case 'c':
              strip.strip[i] = 0x00f0f0; // Cyan    
            break;
            case 'm':
              strip.strip[i] = 0xf0f000; // Magenta    
            break;
            case 'y':
              strip.strip[i] = 0xf000f0; // Yellow 
            break;
            case 'w':
              strip.strip[i] = 0xffffff; // White  
            break;
            case 'o':
              strip.strip[i] = 0x000000; // Off   
            break;            
            default:
              strip.strip[i] = 0x101010; //In case something else happens
            break;
          } 
        }
        
        strip.updateStrip(); //Send the current configuration to the strip

    //Serial.println(rx); // Print what was received for debugging
  }
}
