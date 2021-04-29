/*
 * This class should handle other classes and tell them what to do and when
 * The brains of the operation
 * 
 * Device is either safe or stolen, which greates two statuses
 * boolean safe = 1; //safe
 * status = 0; //stolen
 * 
 * What device should do if it is tolen?
 * 
 * Was device safe or stolen there is two other statuses relating on how frequently gps data is collected and send.
 * 
 * boolean moving = false, true;
 * 
 * When moving, gps location should be collected and send more frequently, how frequently?
 * when not moving gps location should be checked less frequently, how frequently?
 * if gps is not moving, location do not have to be send to the database.
 *                       Location should not also change if it have not been changed
 * 
 * When not listening for gps or sending location, tracker should sometimes listen lora for orders
 * orders like: Order to make noice /when moving/not moving/stolen/safe
 * 
 *              Status change to safe or stolen /When moving /stolen/safe
 *                  Note: Status should not be changed when not moving.
 *                  Other ways device left alone and standing still could be considered "stolen".
 *                  EXCEPTION: When turning device on, device should be able to change status even when standing still
 *                  Because decice is asking online, if they are stolen or safe.
 *              
 * Tracker should compare new location to old location and determine if status is moving or not moving.
 *        moving if location change is big enough to be movement and not location off
 *            note: gps position should not be able to change so much, that it trickers to device "move"
 *            when it is not moving. Other ways device might get "stolen" when it is standing still.
 *        not moving if location have been relatively same for some time.
 *        Might need to ask lora if standing
 * 
 * Perhaps tracker will make different kind of alarm noice if it is safe or stolen?
 * Or it refuses to make sound when stolen, if alarm noice is not strong enough to draw outside attention
 * 
 * control between sleep and activity?
 */

#include "TrackerClass.h"
#include "loraClass.h"
#include "gpsClass.h"
#include "PiezoClass.h"

boolean safe = true;
boolean nomovement = 0;
int DEBUG = 1;
//Debug 0 = normalrun
//Debug 1 = testrun

String oldLocation = String("NULL"); //what is the old location
String newLocation= String("NEW"); //New location
String locationStatus = String("INVALID"); //Location status

long sleepTime; //needed for timings



void trackerStart()
{
  gpsSetup(); //start gps first
  loraSetup(); //start lora
  piezoSetup();

  locationStatus = String("Location NULL");
  //Device should check if status is set safe or stolen at database
  //use Lora

  //get gps and send start location to database

  //Setup SleepTime
  if(DEBUG == 0)
    {
      sleepTime = 60000; //normal sleeptimes
    }
    else
    {
      //käytetään test run aikoja
      sleepTime = 30000; //tester times
    }

}

void trackerRun()
{
  
  //What tracker should do and maintain itself?

  //Get new location only if it is invalid
  if(locationStatus == "INVALID" || locationStatus == "Location NULL")
  {
    while(!(locationStatus=="VALID" || locationStatus=="OLD"))
    {
      //Pyöritään, kunnes GPS saa joko uuden tai vanhan sijainnin
      newLocation = getLocationData(); //Get location DATA
  
      if(!(newLocation == "INVALID" || newLocation == "Location NULL")&&newLocation!=oldLocation)
      {
        Serial.println("Status now Valid");
        oldLocation = newLocation;
        locationStatus = "VALID";
      }
      else if(!(newLocation == "INVALID" || newLocation == "Location NULL")&&newLocation==oldLocation)
      {
        if(DEBUG ==0)
        {
          //Kun ei testata
          locationStatus="OLD";
          Serial.println("Status now OLD");
        }
        else
        {
          //muulloin vanhakin kelpaa
          locationStatus = "VALID";
          oldLocation = newLocation;
        }
      }
    }
  }

  if(locationStatus == "VALID")
  {
    while(locationStatus != "SENT")
    {
      locationStatus = sendMessage(newLocation);
  
      int X = getMessageInt();

      if(X==8)
      {
        //message failed
        initialize_radio(sleepTime); //Connect to Lora
        locationStatus = "VALID"; //New Send attempt
      }
    }
  }


  if(locationStatus == "SENT" || locationStatus == "OLD")
  {
    long runTime = 0;
    long timeCounter = millis();
    boolean nomovement = true;

    loraSleep(sleepTime); 
    
    //Testing if moving
    //If bike Location is old...movement have not been roadcondition
    //Piezo needs to be reseted
    //if message is sent... piezo needs to be reseted
    ResetPiezo(); //reset Piezo 
    

    //Tehdään whilelooppi jonka ehto on:
    //kun nomovement muuttuu falseksi ja runtime on isompi kuin sleepTime
    //Ehdosta tulee false
    // !(nomovement == false && runTime>sleepTime) tällöin ehto antaa falsen wasta kun molemmat ovat väittämät totta
    //ja while looppi päättyy
    
    while(!(!nomovement && runTime > sleepTime))
    {
      boolean testMove = movementTest();
      if(testMove)
      {
        //Piezossa liikettä
        nomovement = false;
      }
          
      //60000 = 1 min
      //300000 = 5 min
      //600000 = 10 min
      //900000 = 15 min
      
      unsigned long currentTime = millis();
      runTime = currentTime - timeCounter;
      
      if (runTime >sleepTime && nomovement)
      {
        loraSleep(sleepTime);
        delay(sleepTime);
        //Passive time if nothing have happened
        
        Serial.println("laite ei liikkunut lainkaan");

        //start new timer for checking if movement happens.
        timeCounter = millis();
        runTime = 0;
        nomovement = true;
      }
    }
    //Movement happened so new Location is needed
    locationStatus = String("Location NULL");
  }
}
