/*
 * This class is for collecting gps data from gps-module
 * 
 * Needs to retun location data, when asked
 */

#include "gpsClass.h"

#include <TinyGPS++.h>
#include <SoftwareSerial.h>

const int gpsRX = 12;
const int gpsTX = 11; //GPS pins
static const uint32_t gpsBaud = 9600; //GPS BAUD
// The TinyGPS++ object
TinyGPSPlus gps;
// The serial connection to the GPS device
SoftwareSerial gpsSerial(gpsRX, gpsTX); //GPS serial

void gpsSetup()
{
  // Open serial communications and wait for port to open:
  pinMode(gpsRX, INPUT);
  pinMode(gpsTX, OUTPUT);
  gpsSerial.begin(gpsBaud); //gpsport
  Serial.begin(115200); //start serial for everyone
  Serial.println("Startup");
}

String getLocationData()
{
  //haetan lokaatiodataa
  gpsSerial.listen(); //Vaihda kuunneltavaa porttia
  String locationData = String("Location NULL");

  //Serial.println(F("getlocation starts"));

  while (gpsSerial.available() >0)
  {
    //Serial.println(F("whileee"));
    if (gps.encode(gpsSerial.read()))
    {
      if (gps.location.isValid())
      {
       // Serial.println(F("Getting Valid Location"));
        locationData = String(gps.location.lat(), 6);
        locationData = String(locationData + ", " + String(gps.location.lng(), 6));
      }
      else
      {
       // Serial.println(F("INVALID"));
        locationData = String("INVALID");
      }
      
    }
  }
  return locationData;
}
