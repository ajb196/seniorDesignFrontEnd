<?php

$conn = new mysqli("localhost","root","test","sensor_network_db");

$result = $conn->query("DELETE FROM sensor_data");

$conn = new mysqli("localhost","root","test","sensor_network_db");

for ($i = 0; $i < 200; $i++) {
  $x = rand(0,600);
  $y = rand(0,200);

  echo $x;

  if($conn->query("INSERT INTO sensor_data (ID, Datetime, X, Y) VALUES ('" . $i . "','" . (time() + rand(0, 24*60*60)) . "', '" . $x . "', '" . $y . "')") === TRUE){
    echo "success <br>";
  } else {
    echo $conn->error. "<br>";
  }


}

for (; $i < 300; $i++) {
  $x = rand(0,50);
  $y = rand(0,50);

  echo $x;

if($conn->query("INSERT INTO sensor_data (ID, Datetime, X, Y) VALUES ('" . $i . "','" . (time() + rand(0, 24*60*60)) . "', '" . $x . "', '" . $y . "')") === TRUE){
    echo "success <br>";
  } else {
    echo $conn->error. "<br>";
  }


}


for (; $i < 500; $i++) {
  $x = rand(0,600);
  $y = rand(400,600);

  echo $x;

if($conn->query("INSERT INTO sensor_data (ID, Datetime, X, Y) VALUES ('" . $i . "','" . (time() + rand(0, 24*60*60)) . "', '" . $x . "', '" . $y . "')") === TRUE){
    echo "success <br>";
  } else {
    echo $conn->error. "<br>";
  }


}

$conn->close();

?>
