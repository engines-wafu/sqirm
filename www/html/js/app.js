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
      var kpiName = [kpiVal1, kpiVal2, kpiVal3];

      for(var i in data) {
        kpiDesc.push(data[i].kpiDesc);
        kpiArr.push(data[i].kpiVal1);
        kpiArr.push(data[i].kpiVal2);
        kpiArr.push(data[i].kpiVal3);
      }

      var kpiArr = [kpiVal1, kpiVal2, kpiVal3];

      console.log(kpiArr);

      var chartdata = {
        labels: kpiName,
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

