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
        labels: [a, b],
        datasets : [
          {
            backgroundColor: 'rgba(200, 200, 200, 0.75)',
            borderColor: 'rgba(200, 200, 200, 0.75)',
            hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
            hoverBorderColor: 'rgba(200, 200, 200, 1)',
            data: [1, 2],
          }
        ]
      };

      var ctx = $("#mycanvas");

      var myChart = new Chart(ctx, {
          type: 'doughnut',
          data: {
            labels: ["Green", "Yellow", "Red"],
            datasets: [{
              data: [12, 19, 3],
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
            }]
          },
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
              position: 'bottom',
              lineHeight: 1,
              text: 'Self Audits'
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
