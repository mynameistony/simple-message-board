#ifndef Stuff_h
#define Stuff_h

#include <Arduino.h>

//#define DATA_1 (PORTC |=  0X01)    // DATA 1    // for UNO
//#define DATA_0 (PORTC &=  0XFE)    // DATA 0    // for UNO
//#define STRIP_PINOUT (DDRC=0xFF)    // for UNO

#define DATA_1 (PORTF |= 0X01) // DATA 1 // for ATMEGA
#define DATA_0 (PORTF &= 0XFE) // DATA 0 // for ATMEGA
#define STRIP_PINOUT DDRF=0xFF // for ATMEGA



class Strip {
  public:
  
    unsigned long strip[10];
 
    Strip(){
      
      for(int i = 0; i < 10; i++)
        strip[i] = 0x010101;
      
      STRIP_PINOUT;
      
      reset_strip();
      
      mySend(strip);
      
      
    };
       
    void updateStrip(){
      
      mySend(strip);
      
    };

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

void reset_strip()
{
  DATA_0;
  delayMicroseconds(20);
};

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

