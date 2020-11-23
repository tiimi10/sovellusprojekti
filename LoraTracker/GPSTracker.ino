#include <rn2xx3.h>
#include <TinyGPS++.h>
#include <SoftwareSerial.h>


static const int gpsRX = 11, gpsTX = 12; //GPS pins
static const uint32_t gpsBaud = 9600; //GPS BAUD
// The TinyGPS++ object
TinyGPSPlus gps;
// The serial connection to the GPS device
SoftwareSerial gpsSerial(gpsRX, gpsTX); //GPS serial

static const int loraRX = 10, loraTX = 9; //Lora pins
SoftwareSerial loraSerial(loraRX, loraTX);
static const uint32_t loraBaud = 57600; //Lora BAUD
int resetPin = 13;
rn2xx3 myLora(loraSerial);

void setup(){
  // Open serial communications and wait for port to open:
  pinMode(gpsRX, INPUT);
pinMode(loraRX, INPUT);
pinMode(gpsTX, OUTPUT);
pinMode(loraTX, OUTPUT);
 Serial.begin(115200);
  loraSerial.begin(loraBaud); //Loraport
  gpsSerial.begin(gpsBaud); //gpsport
  Serial.println("Startup");

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
  const char *devAddr = "02017201";
  const char *nwkSKey = "AE17E567AECC8787F749A62F5541D522";
  const char *appSKey = "8D7FFEF938589D95AAD928C2E2E7E48F";

  join_result = myLora.initABP(devAddr, appSKey, nwkSKey);

  /*
   * OTAA: initOTAA(String AppEUI, String AppKey);
   * If you are using OTAA, paste the example code from the TTN console here:
   */
  //const char *appEui = "70B3D57ED00001A6";
  //const char *appKey = "A23C96EE13804963F8C2BD6285448198";

  //join_result = myLora.initOTAA(appEui, appKey);


  while(!join_result)
  {
    Serial.println("Unable to join. Are your keys correct, and do you have TTN coverage?");
    delay(60000); //delay a minute before retry
    join_result = myLora.init();
  }
  Serial.println("Successfully joined TTN");
}

void displayInfo()
{
  Serial.print(F("Location: ")); 
  if (gps.location.isValid())
  {
    Serial.print(gps.location.lat(), 6);
    Serial.print(F(","));
    Serial.println(gps.location.lng(), 6);
  }
  else
  {
    Serial.println(F("INVALID"));
  }
}

void loop()
{
 // This sketch displays information every time a new sentence is correctly encoded.
 //First starting gpsSerial
 gpsSerial.listen(); //Vaihda kuunneltavaa porttia
 while (gpsSerial.available() >0)
    if (gps.encode(gpsSerial.read()))
      displayInfo();

   
  //  myLora.tx("!"); //one byte, blocking function
}
