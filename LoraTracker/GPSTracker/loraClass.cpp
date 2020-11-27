/*
 * 
 * This class is for Lora communication, getting messages and sending them
 * 
 */

#include "loraClass.h"
#include <SoftwareSerial.h>

static const int loraRX = 10;
static const int loraTX = 9; //Lora pins
SoftwareSerial loraSerial(loraRX, loraTX);
static const uint32_t loraBaud = 57600; //Lora BAUDS
static const int resetPin = 13;
rn2xx3 myLora(loraSerial);

void loraSetup()
{
  //setup lora
  pinMode(loraRX, INPUT);
  pinMode(loraTX, OUTPUT);
  loraSerial.begin(loraBaud); //Loraport

  loraSerial.listen(); //Listen Lora first

  initialize_radio();

  //transmit a startup message
  myLora.tx("TTN Mapper on TTN Enschede node");
}

void initialize_radio()
{
  //reset rn2483
  pinMode(resetPin, OUTPUT);
  digitalWrite(resetPin, LOW);
  delay(500);
  digitalWrite(resetPin, HIGH);

  delay(100); //wait for the RN2xx3's startup message
  loraSerial.flush();

  //Autobaud the rn2483 module to 9600. The default would otherwise be 57600.
  myLora.autobaud();

  //check communication with radio
  String hweui = myLora.hweui();
  while(hweui.length() != 16)
  {
    Serial.println("Communication with RN2xx3 unsuccessful. Power cycle the board.");
    Serial.println(hweui);
    delay(10000);
    hweui = myLora.hweui();
  }

  //print out the HWEUI so that we can register it via ttnctl
  Serial.println("When using OTAA, register this DevEUI: ");
  Serial.println(myLora.hweui());
  Serial.println("RN2xx3 firmware version:");
  Serial.println(myLora.sysver());

  //configure your keys and join the network
  Serial.println("Trying to join TTN");
  bool join_result = false;


  /*
   * ABP: initABP(String addr, String AppSKey, String NwkSKey);
   * Paste the example code from the TTN console here:
   */
 // const char *devAddr = "02017201";
 // const char *nwkSKey = "AE17E567AECC8787F749A62F5541D522";
  // const char *appSKey = "8D7FFEF938589D95AAD928C2E2E7E48F";

  //join_result = myLora.initABP(devAddr, appSKey, nwkSKey);

  /*
   * OTAA: initOTAA(String AppEUI, String AppKey);
   * If you are using OTAA, paste the example code from the TTN console here:
   */
  const char *appEui = "70B3D57ED00001A6";
  const char *appKey = "90B5E34281F9D9B2D532CB03B594381E";

  join_result = myLora.initOTAA(appEui, appKey);


  while(!join_result)
  {
    Serial.println("Unable to join. Are your keys correct, and do you have TTN coverage?");
    delay(60000); //delay a minute before retry
    join_result = myLora.init();
  }
  Serial.println("Successfully joined TTN");
}

//Lora needs function that asks from database, if device is stolen or safe. 1 = safe, 0 = stolen
//function returns boolean result. If there is no result... device assumes, it is safe, return 1


//lora needs function to listen for messages. Return message info to TrackerClass
   //order to make noice
   //status change to safe
   //status change to stolen

//lora needs function for sending location data

//Function for asking if standing still. return boolean answer: 1 = moving, 0 = not moving
