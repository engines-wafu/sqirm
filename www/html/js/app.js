$(document).ready(function(){
  $.ajax({
    url: "http://ec2-13-56-14-28.us-west-1.compute.amazonaws.com/api/data.php",
    method: "GET",
    success: function(data) {
      console.log(data);

      var kpiCharts = [];
      var kpiIDs = [];
      var kpiVal1 = [];
      var kpiVal2 = [];
      var kpiVal3 = [];
      
      for(var i in data){
        kpiCharts.push(data[i].kpiDesc);
        kpiVal1.push(data[i].kpiVal1);
        kpiVal2.push(data[i].kpiVal2);
        kpiVal3.push(data[i].kpiVal3);
      }
      
      console.log(kpiCharts);

      for(var i in data){
        kpiIDs.push(data[i].kpiID);
      }
      
      console.log(kpiIDs);

      //create canvases for each chart
      
      var ctx = [];
      var ctemp = ["#kpicanvas"];
      var kpiCanvas = [];
      
      for(var i in data){
        ctx = ctemp + kpiIDs[i];
        kpiCanvas.push(ctx);
      }
      
      console.log(kpiCanvas);

      //create datasets for each chart
  
      var dtx = [];
      var dtemp = ["dataset"];
      var kpidatasetarray= [];

      for(var i in data){
        dtx = dtemp + kpiIDs[i];
        kpidatasetarray.push(dtx);
      }

      console.log(kpidatasetarray);

      for(var i in kpidatasetarray){
        kpidatasetarray[i] = [];
        kpidatasetarray[i].push(kpiVal1[i], kpiVal2[i], kpiVal3[i]);
        console.log(kpidatasetarray[i]);
      }

      for(var i in kpiCharts){
        var chartdata = {
          labels: ["In Limits", "Near Limits", "Out of Limits"],
          datasets : [
            {
              label: kpiCharts[0],
              backgroundColor: [
                'green',
                'yellow',
                'red'
              ],
              borderColor: 'black',
              borderWidth: 3,
              data: kpidatasetarray[0]
            }
          ]
        };
        var Graph = new Chart(kpiCanvas[0], {
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
              text: kpiCharts[0]
            },
            layout:{
              padding:40
            },
          }
        });
      },
    error: function(data) {
    }
  });
});

