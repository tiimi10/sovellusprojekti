const int buzzer = 9;

void setup() {
  pinMode(buzzer, OUTPUT);

}

void loop() {
  tone(buzzer, 1000); // make 1KHz sound
  delay(1000);        // delay 1 sec
  noTone(buzzer);     // stop sound
  delay(1000);        // delay 1 sec

}
