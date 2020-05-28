#include <DHT.h>        
#include <ESP8266WiFi.h>
#include <WiFiClient.h> 
#include <ESP8266WebServer.h>
#define DHTTYPE DHT11  
#define WIFI_SSID "Xiaomi_router"
#define WIFI_PASSWORD "M1router"
#define dht_dpin D2

char server[] = "192.168.31.165";
float hum;
float temp;
float light;

WiFiClient client; 

DHT dht(dht_dpin, DHTTYPE); 

void setup()
{ 
  Serial.begin(9600);
  dht.begin();
  WiFi.begin(WIFI_SSID, WIFI_PASSWORD);
  Serial.print("connecting");
  while (WiFi.status() != WL_CONNECTED) {
    Serial.print(".");
    delay(500);
  }
  Serial.println();
  Serial.print("connected: ");
  Serial.println(WiFi.localIP());
  
}


void loop() {
  light = analogRead(A0);
  light=light*100/1024; 
  hum = dht.readHumidity();
  temp = dht.readTemperature();
  Sending_To_phpmyadmindatabase(); 
  Serial.println(light);
  Serial.println(hum);
  Serial.println(temp);
  delay(1800000);
}
  void Sending_To_phpmyadmindatabase()   
 {
   if (client.connect(server, 80)) {
    Serial.println("connected");
    // Make a HTTP request:
    Serial.print("GET /MeteoStanica/dht.php?humidity=");
    client.print("GET /MeteoStanica/dht.php?humidity=");    
    Serial.println(hum);
    client.print(hum);
    client.print("&temperature=");
    Serial.println("&temperature=");
    client.print(temp);
    Serial.println(temp);
    client.print("&light=");
    Serial.println("&light=");
    client.print(light);
    Serial.println(light);
    client.print(" ");      
    client.print("HTTP/1.1");
    client.println();
    client.println("Host: 192.168.31.165");
    client.println("Connection: close");
    client.println();
  } 
  else {
    Serial.println("connection failed");
  }
}

  
