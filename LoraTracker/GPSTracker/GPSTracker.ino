#include "TrackerClass.h" //controls lora, gps and inner logic

void setup(){
  trackerStart();
}

void loop()
{
  trackerRun();
  
  //TEST:::
  //readDownlink();
  //delay(30000);
}
