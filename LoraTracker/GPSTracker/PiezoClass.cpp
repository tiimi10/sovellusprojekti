#include "PiezoClass.h"
#include "gpsClass.h"

int Values1 = 0;
int Values2 = 0;
int Values3 = 0;
int Values4 = 0;
int Values5 = 0;
int Values6 = 0;

const int PIEZO_PIN = A5;

void piezoSetup() 
{
  //if needed
}

bool movementTest()
{
  int piezoValue= analogRead(PIEZO_PIN);
  int piezoTest = piezoValue*5000 / 1023;
  if(piezoTest > 6)
  {
    Filtering(piezoTest);
    return true;
  }
  
  return false;
}

void Filtering(int piezoV)
{
  if(469 < piezoV)
  {
    Values1 ++;
    Values2 ++;
    Values3 ++;
    Values4 ++;
    Values5 ++;
    Values6 ++;
  }

  else if(312 < piezoV)
  {
    Values1 ++;
    Values2 ++;
    Values3 ++;
    Values4 ++;
    Values5 ++;
  }

  else if(229 < piezoV)
  {
    Values1 ++;
    Values2 ++;
    Values3 ++;
    Values4 ++;
  }
  else if(146 < piezoV)
  {
    Values1 ++;
    Values2 ++;
    Values3 ++;
  }
  else if(82 < piezoV)
  {
    Values1 ++;
    Values2 ++;
  }
  else if(6 < piezoV)
  {
    Values1 ++;
  }
}

int Roadcondition()
{
  float Roadcond = (1.11*Values1+1.66*Values2+1.88*Values3+1.99*Values4+2.05*Values5+2.09*Values6)/Values1;
  
  int tulos = Roadcond +0.5;

  if(Roadcond >9)
  {
    return 9;
  }
  
  return tulos;
}

void ResetPiezo()
{
  int Values1 = 0;
  int Values2 = 0;
  int Values3 = 0;
  int Values4 = 0;
  int Values5 = 0;
  int Values6 = 0;
}
