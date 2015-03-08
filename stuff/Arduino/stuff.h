#ifndef Stuff_h
#define Stuff_h

#include <Arduino.h> // Include standard things

//Uncomment this section if using an UNO
//#define DATA_1 (PORTC |=  0X01)    // DATA 1    // for UNO
//#define DATA_0 (PORTC &=  0XFE)    // DATA 0    // for UNO
//#define STRIP_PINOUT (DDRC=0xFF)    // for UNO

//Uncomment this section if using a MEGA
#define DATA_1 (PORTF |= 0X01) // DATA 1 // for ATMEGA
#define DATA_0 (PORTF &= 0XFE) // DATA 0 // for ATMEGA
#define STRIP_PINOUT DDRF=0xFF // for ATMEGA



class Strip { // Define the Strip object

  public: // Let's make eveything public because really? Does it matter?
  
    unsigned long strip[10]; // An array representing the colors of the strip
 
    Strip(){ // Initializer (Gets called when the object is created)
      
      for(int i = 0; i < 10; i++) // Set the strip array to dim whites
        strip[i] = 0x010101;
      
      STRIP_PINOUT; // Set the pin configuration
      
      reset_strip(); // Reset strip
      
      mySend(strip); // Send the array to the strip
      
      
    };
       
    void updateStrip(){ // Wrapper for mySend
      
      mySend(strip);
      
    };


// This function is not mine, and provided with the strip
// This is what does the low-level bitbanging to precicely transmit the data to the strip
void send_strip(uint32_t data)
{
  int i;
  unsigned long j=0x800000;
  
 
  for (i=0;i<24;i++)
  {
    if (data & j)
    {
      DATA_1;
      __asm__("nop\n\t");
      __asm__("nop\n\t");
      __asm__("nop\n\t");
      __asm__("nop\n\t");
      __asm__("nop\n\t");
      __asm__("nop\n\t");
      __asm__("nop\n\t");
      __asm__("nop\n\t");
      __asm__("nop\n\t");    
      __asm__("nop\n\t");
      __asm__("nop\n\t");
      __asm__("nop\n\t");
      __asm__("nop\n\t");
      __asm__("nop\n\t");
      __asm__("nop\n\t");
      __asm__("nop\n\t");
      __asm__("nop\n\t");
      __asm__("nop\n\t");
      
/*----------------------------*/
      __asm__("nop\n\t");
      __asm__("nop\n\t");
      __asm__("nop\n\t");
      __asm__("nop\n\t");
      __asm__("nop\n\t");  
      __asm__("nop\n\t");
      __asm__("nop\n\t");
      __asm__("nop\n\t");  
      __asm__("nop\n\t");  
      __asm__("nop\n\t");        
/*----------------------------*/      
      DATA_0;
    }
    else
    {
      DATA_1;
      __asm__("nop\n\t");
      __asm__("nop\n\t");
      __asm__("nop\n\t");
      __asm__("nop\n\t");
      __asm__("nop\n\t");
      __asm__("nop\n\t");
      __asm__("nop\n\t");
      __asm__("nop\n\t");
      __asm__("nop\n\t");    
      DATA_0;
/*----------------------------*/      
       __asm__("nop\n\t");
      __asm__("nop\n\t");
      __asm__("nop\n\t");      
/*----------------------------*/         
    }

    j>>=1;
  }  
};

// This is also not mine
void reset_strip()
{
  DATA_0;
  delayMicroseconds(20);
};

// This is a modified version of the one provided
void mySend(unsigned long data[10]){
  int j=0;
  uint32_t temp_data;
    noInterrupts();
    for (j=0;j<10;j++)
    {
      temp_data=data[j];
      send_strip(temp_data);
    }
    interrupts();

}; 
  
};

#endif

