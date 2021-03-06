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

#include "gpsClass.h"
#include "loraClass.h"

boolean safe = true;
boolean moving = 0;
int DEBUG = 1;
//Debug 0 = normalrun
//Debug 1 = testrun

String oldLocation; //what is the old location
String newLocation; //New location
String locationStatus = String("INVALID"); //Location status
int countTinyChange; //if certain amount of tiny location change happen
                     //status change to not moving

long sleepTime; //needed for timings


void trackerStart()
{
  gpsSetup(); //start gps first

  loraSetup(); //start lora

  locationStatus = String("Location NULL");
  //Device should check if status is set safe or stolen at database
  //use Lora

  //get gps and send start location to database

}

void trackerRun()
{
  
  //What tracker should do and maintain itself?

  //Get new location only if it is invalid
  if(locationStatus == "INVALID" || locationStatus == "Location NULL")
  {
    delay(500); //time for gps
    locationStatus = getLocationData(); //Get location DATA

    if(!(locationStatus == "INVALID" || locationStatus == "Location NULL"))
    {
      newLocation = locationStatus;
      //Compare old location to new... shall send?
      //If not send, change locationstatus to
      //Location OLD
      //if not old, make oldLocation NewLocation
    }
  }

  if(!(locationStatus == "INVALID" || locationStatus == "Location NULL" || locationStatus == "OLD" || locationStatus == "SENT"))
  {
    locationStatus = sendMessage(locationStatus);

    //Kasperi
    //Tässä kohtaa katso mitä txInt arvo on.
    //Jos arvo on 0, merkiste laite nyysityksi safe = 0
    //jos 1 merkitse laite safe = 1
    //muussa tapauksessa ei täl kertaa tehdä mitään
    //kyseisen intin saa funktiolla getMessageInt()
    //esim
    int X = getMessageInt();

    if(X == 1)
    {
      //Jos X = 1, laite on safe tilassa, jolloinka se lähettää dataa hitaammin
      safe = true;
    }

    else if (X == 0)
    {
     safe = false;
    }
    else if (X==8)
    {
      initialize_radio(30000);
      locationStatus = newLocation;
    }
  }


  if(locationStatus == "SENT" || locationStatus == "OLD")
  {
    //60000 = 1 min
    //300000 = 5 min
    //600000 = 10 min
    //900000 = 15 min
    
    if(DEBUG == 0)
    {
      sleepTime = 600000; //normal sleeptimes
  
      //Jos laite nyysitty, silloin nukututaan vähän
      if(safe == false)
      {
        sleepTime = 60000; //normal sleeptime
      }
    }
    else
    {
      //käytetään test run aikoja
      sleepTime = 60000; //tester times
  
      //Jos laite nyysitty, silloin nukututaan vähän
      if(safe == false)
      {
        sleepTime = 30000; //tester times
      }
    }
    loraSleep(sleepTime); //10 min
    locationStatus = String("Location NULL");
    delay(sleepTime); //for now the same
  }
  
}
