$(document).ready(function(){
  $.ajax({
    url: "../html/data.php",
    method: "GET",
    success: function(data) {
      console.log(data);
      var kpiDesc = [];
      var kpiVal1 = [];

      for(var i in data) {
        kpiDesc.push(data[i].kpiDesc);
        kpiVal1.push(data[i].kpiVal1);
      }
      <h1>IMPORTANT</h1>
    })

    error: function(data) {
      console.log(data);
    }
  });
});
