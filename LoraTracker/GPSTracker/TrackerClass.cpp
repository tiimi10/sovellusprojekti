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

boolean safe = 1;
boolean moving = 0;

int oldLocation; //what is the old location
int newLocation; //current location to compare with old location
int countTinyChange; //if certain amount of tiny location change happen
                     //ask lora if standing still.


void trackerStart()
{
  gpsSetup(); //start gps first

  loraSetup(); //start lora

  //Device should check if status is set safe or stolen at database
  //use Lora

  //get gps and send start location to database
}

void trackerRun()
{
  //What tracker should do and maintain itself?
  getLocation(); //now always printing location
}
