<?php

$conn = new mysqli("localhost","test","test","telemetry_readings");

$result = $conn->query("DELETE FROM readings");

$conn = new mysqli("localhost","test","test","telemetry_readings");

for ($i = 0; $i < 200; $i++) {
  $x = rand(0,600);
  $y = rand(0,200);

  echo $x;

  if($conn->query("INSERT INTO readings (x, y, time_in_seconds) VALUES ('" . $i . "','" . (time() + rand(0, 24*60*60)) . "', '" . $x . "', '" . $y . "')") === TRUE){
    echo "success <br>";
  } else {
    echo $conn->error. "<br>";
  }


}

for (; $i < 300; $i++) {
  $x = rand(0,50);
  $y = rand(0,50);

  echo $x;

if($conn->query("INSERT INTO readings (x, y, time_in_seconds) VALUES ('" . $i . "','" . (time() + rand(0, 24*60*60)) . "', '" . $x . "', '" . $y . "')") === TRUE){
    echo "success <br>";
  } else {
    echo $conn->error. "<br>";
  }


}


for (; $i < 500; $i++) {
  $x = rand(0,600);
  $y = rand(400,600);

  echo $x;

if($conn->query("INSERT INTO readings (time_in_seconds, X, Y) VALUES ('" . $i . "','" . (time() + rand(0, 24*60*60)) . "', '" . $x . "', '" . $y . "')") === TRUE){
    echo "success <br>";
  } else {
    echo $conn->error. "<br>";
  }


}

$conn->close();

?>
