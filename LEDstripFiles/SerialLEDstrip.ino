#include "stuff.h"

//Create a "Strip object" to simplify sending data to the LED strip
Strip strip;

// A few useful variables
char currentMode = '0';

unsigned long pulseColor = 0;

unsigned long pulsePos = 1;

int pulseDirection = 0;

unsigned long data[10];

int rainbowPos = 0;

// Define all the colors in the rainbow
unsigned long rainbowColors[10] ={
  0xff0000, 0xff0099, 0xff00ff, 0x9900ff, 0x0000ff, 0x0099ff, 0x00ff00, 0x99ff33, 0xffff00, 0xff0000
};

// Used to add a non-blocking delay on the rainbow cycle
unsigned long lastRainbow = 0;


void setup(){
	Serial.begin(9600);
}

void loop(){
  
	if(Serial.available()){ // If we get something...
    
		String rx = Serial.readStringUntil('\n'); // Read it into a string
      
		//Debugging
		//Serial.print("Start: "); 
		//Serial.println(rx);
    
		if(rx[0] == 'M'){ //If we get a mode change...

			currentMode = rx[1]; // Set the new mode
        
			// If its a pulse mode
			if(currentMode == '1'){ 
          
				char strPulseColor[6]; // String to hold our color before converting to unsigned long
		  
				// rx will be something like:
				// "M1ff00ff"

				// Extract the desired pulse color
				for(int i = 2; i < rx.length(); i++)
					strPulseColor[i-2] = rx[i];
		  
				// Convert it to an unsigned long
				pulseColor = strtoul(strPulseColor,NULL,16);
		  
				// Reset the pulse position
				pulsePos = pulseColor;

				//Debugging
				//Serial.print("Setting pulse for: ");
				//Serial.println(pulseColor, HEX);            
			}
        
			//Debugging
			//Serial.print("Setting mode: "); 
			//Serial.println(currentMode); 
      
		}
		else{  // Otherwise we received the hex values for colors to light up

			// rx will be something like:
			// "#ff00ff#ffffff..."

			// Variable to hold what LED we are setting
			int stripPos = 0;      

			// Set the current mode to static
			currentMode = 0;
	    
			for(int i = 0; i < rx.length(); i++){ // For each char in the string...
	      
				if(rx[i] == '#'){ // if it is the start of a new value
					char test[6];
					test[0] = rx[i+1];
					test[1] = rx[i+2];
					test[2] = rx[i+3];
					test[3] = rx[i+4];
					test[4] = rx[i+5];
					test[5] = rx[i+6]; // Read in the next six values to a string

					data[stripPos++] = strtoul(test,NULL,16); // Convert string to unsigned long and store it
				}
			}

			//Set our LED strip array to our new configuration
			for(int i = 0; i < stripPos; i++){
				strip.strip[i] = data[i];
				//Debugging
				//Serial.print(",");
				//Serial.print(data[i], HEX); // Print unsigned long data in decimal
			}
			//Serial.println();
			// Update the strip with its new array

			strip.updateStrip();
		}
	}
  
	// Check what mode we're in...
	switch(currentMode){

		// static LED configuration (do nothing)
		case '0':
			//Serial.println("Static");
		break; 

		// Pulse Mode
		case '1':
			//Update the strip each loop, in a non-blocking way
			pulsePos = pulse(pulsePos, pulseColor);

			//Debugging
			//Serial.print("Pulsing: ");
			//Serial.println(pulseColor, HEX);
		break;

		// Rainbow Mode
		case '2':
			//Check that it's time for the next iteration...
			if(millis() - lastRainbow > 100){
				lastRainbow = millis();  
				rainbowPos = rainbow(rainbowPos);
			}
			//Debugging
			//Serial.println("Rainbow");
		break;

	}
}

unsigned long pulse(unsigned long current, unsigned long target){
	//Debugging
	//Serial.print("Current pulse: ");
	//Serial.println(current, HEX);

	unsigned long interval = 1;

	if(target > 0x0000ff)
		interval = 0x000100;  
	if(target > 0x00ffff)
		interval = 0x010000;

	for(int i = 0; i < 10; i++)
		strip.strip[i] = current;

	if(current >= target)
		pulseDirection = 0;
	else
	if(current <= 1)
		pulseDirection = 1;

	strip.updateStrip();

	if(pulseDirection)
		return current + interval;
	else
		return current - interval;

}

int rainbow(int currentPos){
	for(int i = 0; i < 10; i++){
		if(i < 9)
			rainbowColors[i] = rainbowColors[i+1];
		else
			rainbowColors[i] = rainbowColors[0];

		strip.strip[i] = rainbowColors[i];
		strip.updateStrip();  
	}  

}
