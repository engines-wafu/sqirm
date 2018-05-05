$(document).ready(function(){
  $.ajax({
    url: "http://ec2-13-56-14-28.us-west-1.compute.amazonaws.com/api/data.php",
    method: "GET",
    success: function(data) {
      console.log(data);

      var kpiCharts = [];
      var kpiIDs = [];
      
      for(var i in data){
        kpiCharts.push(data[i].kpiDesc);
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
      
      for(var i in kpiIDs){
        ctx = ctemp + kpiIDs[i] ;
        kpiCanvas.push(kpiIDs[i].ctx);
      }
      
      console.log(ctx);
      console.log(ctemp);
      console.log(kpiCanvas);

    },
    error: function(data) {
    }
  });
});

      //var kpiDesc = [];
      //var kpiVal1 = [];
      //var kpiVal2 = [];
      //var kpiVal3 = [];
      //var kpiArr = [];
      //var kpiData = [];

      //for(var i in data) {
      //  kpiDesc.push(data[i].kpiDesc);
      //  do {
      //    kpiData.push(data[i].kpiVal1);
      //    kpiData.push(data[i].kpiVal2);
      //    kpiData.push(data[i].kpiVal3);
      //  }
      //  while (kpiDesc = i);
      //}

      //console.log(kpiDesc);
      //console.log(kpiData);

      //var chartdata = {
      //  labels: ["In Limits", "Near Limits", "Out of Limits"],
      //  datasets : [
      //    {
      //      label: 'KPI Score',
      //      backgroundColor: [
      //        'green',
      //        'yellow',
      //        'red'
      //      ],
      //      borderColor: 'black',
      //      borderWidth: 3,
      //      data: kpiArr
      //    }
      //  ]
      //};

      //var ctx = $("#kpicanvas") + kpiID[i];

      //var Graph = new Chart(ctx, {
      //  type: 'doughnut',
      //  data: chartdata,
      //  options: {
      //    circumference: Math.PI,
      //    rotation: 1.0 * Math.PI,
      //    percentageInnerCutout: 10,
      //    responsive: false,
      //    legend: {
      //      display: false
      //    },
      //    title: {
      //      display: true,
      //      fontFamily: 'Arial',
      //      fontColor: 'black',
      //      lineHeight: 1,
      //      text: kpiDesc
      //    },
      //    layout:{
      //      padding:40
      //    },
      //  }
      //});
