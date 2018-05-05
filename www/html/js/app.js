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
      var kpiArr = [];

      for(var i in data) {
        kpiDesc.push(data[i].kpiDesc);
        kpiArr.push(data[i].kpiVal1);
        kpiArr.push(data[i].kpiVal2);
        kpiArr.push(data[i].kpiVal3);
      }

      console.log(kpiDesc);
      console.log(kpiArr);

      var chartdata = {
        labels: ["Red", "Amber", "Green"],
        datasets : [
          {
            label: 'KPI Score',
            backgroundColor: [
              'green',
              'yellow',
              'red',
            ],
            borderColor: [
              'black',
              'black',
              'black',
            ],
            borderWidth: 3
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

