$(document).ready(function(){
  $.ajax({
    url: "http://www.blackcataerospace.com/data.php",
    method: "GET",
    success: function(data) {
      console.log(data);
      var kpiDesc = [];
      var kpiVal1 = [];

      for(var i in data) {
        kpiDesc.push(data[i].kpiDesc);
        kpiVal1.push(data[i].kpiVal1);
      }

      var chartdata = {
        labels: kpiDesc,
        datasets : [
          {
            label: 'Player Score',
            backgroundColor: 'rgba(200, 200, 200, 0.75)',
            borderColor: 'rgba(200, 200, 200, 0.75)',
            hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
            hoverBorderColor: 'rgba(200, 200, 200, 1)',
            data: kpiVal1
          }
        ]
      };

      var ctx = $("#mycanvas");

      var barGraph = new Chart(ctx, {
        type: 'bar',
        data: chartdata
      });
    },
    error: function(data) {
      console.log(data);
    }
  });
});
