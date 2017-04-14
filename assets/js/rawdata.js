window.onload = function() {


  var points = [];

  var table = document.getElementById("dataTable");

  $.getJSON("http://localhost/SeniorDesign/heatData.php", function(returned) {

    for(var i = 0; i < returned.maxX; i++) {
      for(var j = 0; j < returned.maxY; j++) {
        var point = {
          x: i,
          y: j,
          value: returned.data[i][j]

        };

        if (returned.data[i][j] != 0) {
          var row = table.insertRow(0);
          var cell1 = row.insertCell(0);
          var cell2 = row.insertCell(1);
          var cell3 = row.insertCell(2);
          cell1.innerHTML = i;
          cell2.innerHTML = j;
          cell3.innerHTML = returned.data[i][j];
        }

      }
    }


  }).fail(function() {
    console.log("error");
  });

};
