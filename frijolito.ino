#include <DHT.h>
#include <DHT_U.h>
#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <Wire.h>

#define DHTPIN 14 //D5 Declarar Sensor de Temperatura y Humedad
#define DHTPIN2 12
#define DHTTYPE DHT11

DHT dht(DHTPIN, DHTTYPE);
DHT dht2(DHTPIN2, DHTTYPE);

const char* ssid = "INFINITUMECF1_2.4";
const char* password = "0187980729";
char servername[] = "site.com";

int ledpin = 0;
int I2CSDA = 4; //D4
int I2CSCL = 5;
int motorpin = 13;
int fanpin = 16; //D2

int valorsuelo = 0;
int valorsuelo2 = 0;
float nivel = 0;
float valorhum = 0;
float valortemp = 0;
float valorhum2 = 0;
float valortemp2 = 0;

String estadomotor = "0";
String estadofan = "0";
String estadoled1 = "0";
String estadohs = "0"; //Humedad del suelo estado On Off
String estadoth = "0"; //Temperatura y Humedad estado On Off
String payload;

String SHA0, SHA1, SHA2;

WiFiClient client;

void setup() {
  Serial.begin(115200);
  dht.begin();
  dht2.begin();
  Wire.begin();

  pinMode(ledpin, OUTPUT);
  //pinMode(I2CSDA,OUTPUT);
  //pinMode(I2CSCL,OUTPUT);
  digitalWrite(ledpin, LOW);
  //digitalWrite(I2CSDA,HIGH);
  //digitalWrite(I2CSCL,HIGH);

  Serial.print("Conectando a: ");
  Serial.println(ssid);
  WiFi.begin(ssid, password);

  while (WiFi.status() != WL_CONNECTED)
  {
    delay(400);
    Serial.println("Conectando...");
  }
  Serial.println("Conectado a la red wifi");
}

void loop() {
  SueloHumedad();
  TemperaturaHumedad();
  Motor();
  Fan();
  Led2();
  delay(500);
}

void SueloHumedad()
{
  estadohumedadsu();
  if (estadohs == "1")
  {
    AnalogS();
    valorsuelo = atoi(SHA0.c_str());
    valorsuelo2 = atoi(SHA1.c_str());
    Serial.println("SHA0");
    Serial.println(SHA0);
    Serial.println(valorsuelo);

    Serial.println("SHA1");
    Serial.println(SHA1);
    Serial.println(valorsuelo2);

    valorsuelo = (valorsuelo + valorsuelo2) / 2;
    Serial.println("Total");
    Serial.println(valorsuelo);
    nivel = atoi(SHA2.c_str());
    Serial.println("SHA2 Nivel");
    Serial.println(SHA2);
    Serial.println(nivel);
    nivel = (nivel * 100) / 1023;
    Serial.println(nivel);
    enviarsuelo(valorsuelo);
    enviarnivel(nivel);
    delay(1000);
  }
}

void Led2() {
  estadoled2();
  if (estadoled1 == "1") {
    digitalWrite(ledpin, HIGH);
  } else if (estadoled1 == "0") {
    digitalWrite(ledpin, LOW);
  }
}

void TemperaturaHumedad()
{
  estadotemph();
  if (estadoth == "1")
  {
    valorhum = dht.readHumidity();
    valortemp = dht.readTemperature();
    valorhum2 = dht2.readHumidity();
    valortemp2 = dht2.readTemperature();
    enviar("", valortemp, valorhum);
    enviar("2", valortemp2, valorhum2);
    delay(1000);
  }
}

void Motor()
{
  estadobomba();
  if (estadomotor == "1")
  {
    pinMode(motorpin, OUTPUT);
    digitalWrite(motorpin, HIGH);
  }
  else if (estadomotor == "0")
  {
    pinMode(motorpin, INPUT);
  }
}

void Fan()
{
  estadfan();
  if (estadofan == "1")
  {
    pinMode(fanpin, OUTPUT);
    digitalWrite(fanpin, HIGH);
  }
  else if (estadofan == "0")
  {
    pinMode(fanpin, INPUT);
  }
}

void AnalogS()
{
  Wire.requestFrom(1, 7);
  String punto;

  while (Wire.available()) {
    char c = Wire.read();
    punto = punto + c;
  }

  int n = punto.length();
  char comp[n + 1];
  strcpy(comp, punto.c_str());
  char* id0 = strstr(comp, "A0");
  char* id1 = strstr(comp, "A1");
  char* id2 = strstr(comp, "A2");

  if (id0 != NULL)
  {
    SHA0 = punto;
  }

  if (id1 != NULL)
  {
    SHA1 = punto;
  }

  if (id2 != NULL)
  {
    SHA2 = punto;
  }
}

void estadobomba() {

  HTTPClient http;  //Declare an object of class HTTPClient

  http.begin("site.com/frijolito/wp-content/plugins/frijolito-plugin/lib/motor.txt");  //Specify request destination
  int httpCode = http.GET();                                                                  //Send the request

  if (httpCode > 0) { //Check the returning code

    payload = http.getString();   //Get the request response payload
    Serial.print("Estado Motor: ");
    Serial.println(payload);                     //Print the response payload
    estadomotor = payload;
  }

  http.end();   //Close connection
}

void estadfan() {

  HTTPClient http;  //Declare an object of class HTTPClient

  http.begin("site.com/frijolito/wp-content/plugins/frijolito-plugin/lib/fan.txt");  //Specify request destination
  int httpCode = http.GET();                                                                  //Send the request

  if (httpCode > 0) { //Check the returning code

    payload = http.getString();   //Get the request response payload
    Serial.print("Estado Fan: ");
    Serial.println(payload);                     //Print the response payload
    estadofan = payload;
  }

  http.end();   //Close connection
}

void estadotemph() {

  HTTPClient http;  //Declare an object of class HTTPClient

  http.begin("site.com/frijolito/wp-content/plugins/frijolito-plugin/lib/th.txt");  //Specify request destination
  int httpCode = http.GET();                                                                  //Send the request

  if (httpCode > 0) { //Check the returning code

    payload = http.getString();   //Get the request response payload
    Serial.print("Estado Temperatura y Humedad: ");
    Serial.println(payload);                     //Print the response payload
    estadoth = payload;
  }

  http.end();   //Close connection
}

void estadohumedadsu() {

  HTTPClient http;  //Declare an object of class HTTPClient

  http.begin("site.com/frijolito/wp-content/plugins/frijolito-plugin/lib/hs.txt");  //Specify request destination
  int httpCode = http.GET();                                                                  //Send the request

  if (httpCode > 0) { //Check the returning code

    payload = http.getString();   //Get the request response payload
    Serial.print("Humedad Suelo: ");
    Serial.println(payload);                     //Print the response payload
    estadohs = payload;
  }

  http.end();   //Close connection
}

void estadoled2() {

  HTTPClient http;  //Declare an object of class HTTPClient

  http.begin("site.com/frijolito/wp-content/plugins/frijolito-plugin/lib/led.txt");  //Specify request destination
  int httpCode = http.GET();                                                                  //Send the request

  if (httpCode > 0) { //Check the returning code

    payload = http.getString();   //Get the request response payload
    Serial.print("Led D2: ");
    Serial.println(payload);                     //Print the response payload
    estadoled1 = payload;
  }

  http.end();   //Close connection
}

void enviar(String sensor, float v1, float v2) {
  if (client.connect(servername, 80)) {
    Serial.println("connected");
    // Make a HTTP request:
    client.print("GET /datos");
    client.print(sensor);
    client.print(".php?datos1=");
    client.print(v1);
    client.print("&datos2=");
    client.print(v2);
    client.println(" HTTP/1.1");
    client.println("Host: site.com/frijolito/wp-content/plugins/frijolito-plugin/lib");
    client.println(""); //mandatory blank line
  }
}

void enviarsuelo(float v1) {
  if (client.connect(servername, 80)) {
    Serial.println("connected");
    // Make a HTTP request:
    client.print("GET /suelo.php?datos1=");
    client.print(v1);
    client.println(" HTTP/1.1");
    client.println("Host: site.com/frijolito/wp-content/plugins/frijolito-plugin/lib");
    client.println(""); //mandatory blank line
  }
}

void enviarnivel(float v1) {
  if (client.connect(servername, 80)) {
    Serial.println("connected");
    // Make a HTTP request:
    client.print("GET /nivel.php?datos1=");
    client.print(v1);
    client.println(" HTTP/1.1");
    client.println("Host: site.com/frijolito/wp-content/plugins/frijolito-plugin/lib");
    client.println(""); //mandatory blank line
  }
}
