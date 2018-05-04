$(document).ready(function() {

  /**
   * call the data.php file to fetch the result from db table.
   */
  $.ajax({
    url : "http://ec2-13-56-14-28.us-west-1.compute.amazonaws.com/api/data.php",
    type : "GET",
    success : function(data){
      console.log(data);

      var kpivals = {
        kpiVal1 : [],
        kpiVal2 : [],
        kpiVal3 : []
      };

      var len = data.length;

      for (var i = 0; i < len; i++) {
        if (data[i].kpiDesc == "Self Audits") {
          kpiVal.SAs.push(data[i].kpiVal);
        }
        else if (data[i].kpiDesc == "Open Actions") {
          kpiVal.OAs.push(data[i].kpiVal);
        }
      }

      console.log(kpiVals);

    },
    error : function(data) {
      console.log(data);
    }
  });

});

