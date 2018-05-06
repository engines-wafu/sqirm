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
              label: kpiCharts[i],
              backgroundColor: [
                'green',
                'yellow',
                'red'
              ],
              borderColor: 'black',
              borderWidth: 3,
              data: kpidatasetarray[i]
            }
          ]
        };
        var kpiCanvas[i] = document.getElementById(kpiCanvas[i]).getContext('2d');
        var Graph = new Chart(kpiCanvas[i], {
          type: 'doughnut',
          data: chartdata,
          options: {
	           maintainAspectRatio: true,	
            circumference: Math.PI,
            rotation: 1.0 * Math.PI,
            percentageInnerCutout: 10,
            legend: {
              display: false
            },
            title: {
              display: false,
              fontFamily: 'Arial',
              fontColor: 'black',
              lineHeight: 1,
              text: kpiCharts[i]
            },
            layout:{
              padding:40
            },
          }
        });
      }
    },
    error: function(data) {
    }
  });
});

