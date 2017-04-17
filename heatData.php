<?php

  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Methods: GET, POST');

  Class Map {
    public $max = 0;
    public $maxX = 0;
    public $maxY = 0;
    public $data = array();
  }

    $conn = new mysqli("localhost","test","test","telemetry_readings");

    $result = $conn->query("SELECT MAX(x) as x, MAX(y) as y FROM readings");

    while($row = $result->fetch_assoc()) {
        $maxX = $row["x"];
        $maxY = $row["y"];
    }

    $map = array();
    $maxV = 0;

    for ($i = 0; $i <= $maxX; $i++) {
      for ($k = 0; $k <= $maxY; $k++) {
        $map[$i][$k] = 0;
      }
    }

    if(isset($_GET["startStamp"]) && isset($_GET["endStamp"])) {
      $result = $conn->query("SELECT * FROM readings WHERE 'time_in_seconds' BETWEEN " . $_GET["startStamp"] . " AND " . $_GET["endStamp"]);
    } else {
      $result = $conn->query("SELECT * FROM readings");
    }



    $i = 0;
    while($row = $result->fetch_assoc()) {
        $map[$row["x"]][$row["y"]] = $map[$row["x"]][$row["y"]] + 1;
        if ($map[$row["x"]][$row["y"]] > $maxV) {
          $maxV = $map[$row["x"]][$row["y"]];
        }
    }
    $conn->close();


    $myObj = new Map;

    $myObj->max = $maxV;
    $myObj->maxX = $maxX;
    $myObj->maxY = $maxY;
    $myObj->data = $map;

    echo json_encode($myObj);

 ?>
