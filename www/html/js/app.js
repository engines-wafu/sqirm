$(document).ready(function(){
  $.ajax({
    url: "http://ec2-13-56-14-28.us-west-1.compute.amazonaws.com/api/data.php",
    method: "GET",
    success: function(data) {
      console.log(data);
      var kpiDesc = [];
      var kpiVal1 = [];
      var kpiVal2 = [];
      var kpiVal3 = [];

      for(var i in data) {
        kpiDesc.push(data[i].kpiDesc);
      }

      console.log(kpiDesc);

      var chartdata = {
        labels: ["Red", "Amber", "Green"],
        datasets : [
          {
            label: 'KPI Score',
            backgroundColor: 'rgba(200, 200, 200, 0.75)',
            borderColor: 'rgba(200, 200, 200, 0.75)',
            hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
            hoverBorderColor: 'rgba(200, 200, 200, 1)',
            data: kpiArr
          }
        ]
      };

      var ctx = $("#mycanvas");

      var Graph = new Chart(ctx, {
        type: 'doughnut',
        data: chartdata
      });
    },
    error: function(data) {
      console.log(data);
    }
  });
});

