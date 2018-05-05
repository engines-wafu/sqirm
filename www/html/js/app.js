$(document).ready(function(){
  $.ajax({
    url: "http://ec2-13-56-14-28.us-west-1.compute.amazonaws.com/api/data.php?kpiID=1",
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
        labels: ["In Limits", "Near Limits", "Out of Limits"],
        datasets : [
          {
            label: 'KPI Score',
            backgroundColor: [
              'green',
              'yellow',
              'red'
            ],
            borderColor: 'black',
            borderWidth: 3,
            data: kpiArr
          }
        ]
      };

      var ctx = $("#kpicanvas");

      var Graph = new Chart(ctx, {
        type: 'doughnut',
        data: chartdata,
	         options: {
            circumference: Math.PI,
            rotation: 1.0 * Math.PI,
            percentageInnerCutout: 10,
            responsive: false,
            legend: {
              display: false
            },
            title: {
              display: true,
              fontFamily: 'Arial',
              fontColor: 'black',
              lineHeight: 1,
              text: kpiDesc
            },
            layout:{
              padding:40
            },
          }
      });
    },
    error: function(data) {
      console.log(data);
    }
  });
});

