<?php

  Class Map {
    public $max = 0;
    public $maxX = 0;
    public $maxY = 0;
    public $data = array();
  }

    $conn = new mysqli("localhost","root","test","sensor_network_db");

    $result = $conn->query("SELECT MAX(X) as X, MAX(Y) as Y FROM sensor_data");

    while($row = $result->fetch_assoc()) {
        $maxX = $row["X"];
        $maxY = $row["Y"];
    }

    $map = array();
    $maxV = 0;

    for ($i = 0; $i <= $maxX; $i++) {
      for ($k = 0; $k <= $maxY; $k++) {
        $map[$i][$k] = 0;
      }
    }

    if(isset($_GET("startStamp")) && isset($_GET("endStamp"))) {
      $result = $conn->query("SELECT * FROM sensor_data WHERE 'Datetime' IN (" . $_GET("startStamp") . ".." . $_GET("endStamp") . ")");
    } else {
      $result = $conn->query("SELECT * FROM sensor_data");
    }



    $i = 0;
    while($row = $result->fetch_assoc()) {
        $map[$row["X"]][$row["Y"]] = $map[$row["X"]][$row["Y"]] + 1;
        if ($map[$row["X"]][$row["Y"]] > $maxV) {
          $maxV = $map[$row["X"]][$row["Y"]];
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
