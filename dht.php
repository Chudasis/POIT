<?php
class dht11{
 public $link='';
 function __construct($temperature, $humidity, $light){
  $this->connect();
  $this->storeInDB($temperature, $humidity, $light);
 }
 
 function connect(){
  $this->link = mysqli_connect('localhost','root','') or die('Cannot connect to the DB');
  mysqli_select_db($this->link,'MeteoStanica') or die('Cannot select the DB');
 }
 
 function storeInDB($temperature, $humidity, $light){
  $query = "INSERT INTO METEOSTANICA.DATA (temperature, humidity, light)
     VALUES ('".$temperature."','".$humidity."','".$light."')";
  $result = mysqli_query($this->link,$query) or die('Errant query:  '.$query);
 }

}
if($_GET['temperature'] != '' and  $_GET['humidity'] != '' and $_GET['light'] != ''){
 $dht11=new dht11($_GET['temperature'],$_GET['humidity'],$_GET['light']);
}

?>
