window.onload = function() {


  var points = [];

  $("#heatmapContainer").height($(window).height());
  $("#heatmapContainer").width($(window).width());

  // minimal heatmap instance configuration
  var heatmapInstance = h337.create({
    // only container is required, the rest will be defaults
    container: document.getElementById('heatmapWrapper')
  });

  $.getJSON("http://localhost/SeniorDesign/heatData.php", function(returned) {

    for(var i = 0; i < returned.maxX; i++) {
      for(var j = 0; j < returned.maxY; j++) {
        var point = {
          x: i + 50,
          y: j + 50,
          value: returned.data[i][j]

        };

        if (returned.data[i][j] != 0) {
          points.push(point);
        }

      }
    }

    var data = {
      max: returned.max,
      data: points
    };

    heatmapInstance.setData(data);
  }).fail(function() {
    console.log("error");
  });

  $("#dateButton").click(function() {
    var startStamp = Date.parse($("#startDate").val() + " " + $("#startTime").val());
    var endStamp = Date.parse($("#endDate").val() + " " + $("#endTime").val());

    if (startStamp == null) {
      $("#start").css({'color':'red'});
    } else {
      $("#start").css({'color':'black'});
    }

    if (endStamp == null) {
      $("#end").css({'color':'red'});
    } else {
      $("#end").css({'color':'black'});
    }

    if (endStamp == null || startStamp == null) {
      return;
    }
    console.log(startStamp.getTime() + "\n" + endStamp.getTime());

    $.getJSON("http://localhost/SeniorDesign/heatData.php?startStamp=" + (startStamp.getTime() / 1000) + "&endStamp=" + (endStamp.getTime() / 1000) , function(returned) {

      for(var i = 0; i < returned.maxX; i++) {
        for(var j = 0; j < returned.maxY; j++) {
          var point = {
            x: i + 50,
            y: j + 50,
            value: returned.data[i][j]

          };

          if (returned.data[i][j] != 0) {
            points.push(point);
          }

        }
      }

      var data = {
        max: returned.max,
        data: points
      };

      heatmapInstance.setData(data);
    }).fail(function() {
      console.log("error");
    });

  });

};
