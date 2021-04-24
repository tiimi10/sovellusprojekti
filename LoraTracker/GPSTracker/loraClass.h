/*
 * 
 * This class is for Lora communication, getting messages and sending them
 * 
 */

 #ifndef loraClass_h
#define loraClass_h

#include <rn2xx3.h>

#endif //ends header

//add function info here, so other classes can use them

void loraSetup();
void initialize_radio(long retryTime);
String sendMessage(String message);
void loraSleep(long msTime);
int readDownlink(String downMessage);
int getMessageInt();
void loraFlush();
