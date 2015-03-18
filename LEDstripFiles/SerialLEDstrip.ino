#include "stuff.h"

Strip strip;

char currentMode = '0';

unsigned long pulseColor = 0;

unsigned long pulsePos = 1;

int pulseDirection = 0;

unsigned long data[10];

int rainbowPos = 0;

unsigned long rainbowColors[10] ={
  0xff0000, 0xff0099, 0xff00ff, 0x9900ff, 0x0000ff, 0x0099ff, 0x00ff00, 0x99ff33, 0xffff00, 0xff0000
};

unsigned long lastRainbow = 0;

void setup(){
  Serial.begin(9600);
}

void loop(){
  
  if(Serial.available()){ // If we get something...
    
      String rx = Serial.readStringUntil('\n'); // Read it into a string
      
      Serial.print("Start: "); // Then print it out
      Serial.println(rx);
    
      if(rx[0] == 'M'){
        currentMode = rx[1];
        
        if(currentMode == '1'){
          
          char strPulseColor[6];
          
          for(int i = 2; i < rx.length(); i++)
            strPulseColor[i-2] = rx[i];
          
          
          pulseColor = strtoul(strPulseColor,NULL,16);
          
          pulsePos = pulseColor;
          Serial.print("Setting pulse for: ");
          Serial.println(pulseColor, HEX);            
        }
        
        Serial.print("Setting mode: "); 
        Serial.println(currentMode); 
      
      }else{  
        int stripPos = 0;      
        currentMode = 0;
    
        for(int i = 0; i < rx.length(); i++){ // For each char in the string...
      
        if(rx[i] == '#'){        
          char test[6];
          test[0] = rx[i+1];
          test[1] = rx[i+2];
          test[2] = rx[i+3];
          test[3] = rx[i+4];
          test[4] = rx[i+5];
          test[5] = rx[i+6];        
          data[stripPos++] = strtoul(test,NULL,16); // Convert char pointer to useful data
        }
      
      
      }
      for(int i = 0; i < stripPos; i++){
        strip.strip[i] = data[i];
        Serial.print(",");
        Serial.print(data[i], HEX); // Print unsigned long data in decimal
      }
    
        Serial.println();
        strip.updateStrip();
    }
  }
  
  switch(currentMode){
    case '0':

      Serial.println("Static");
    break; 
    
    case '1':
      pulsePos = pulse(pulsePos, pulseColor);
      Serial.print("Pulsing: ");
      Serial.println(pulseColor, HEX);
    break;
    
    case '2':
      if(millis() - lastRainbow > 100){
        lastRainbow = millis();  
        rainbowPos = rainbow(rainbowPos);
      }
      
      Serial.println("Rainbow");
    break;
    
  }
}

unsigned long pulse(unsigned long current, unsigned long target){
  Serial.print("Current pulse: ");
  Serial.println(current, HEX);
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
