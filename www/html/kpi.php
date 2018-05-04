<?php include "../inc/dbinfo.inc"; ?>
<html>
  <head>
    <style>
      <?php include "class.css"; ?>
      <?php include "server.php"; ?>
    </style>
  </head>
<body>
<div class="content"><h1>KPI Test Page</h1></div>
<section>
  <article style="border: none;"> </article>
  <article>
    <div>
      <canvas id="myChart" width="150" height="150"></canvas>
      <script src=Chart.js></script>
      <script>
      var ctx = document.getElementById("myChart");
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
              text: 'Custom Chart Title'
            },
            layout:{
              padding:40
            },
          }
      });
      </script>
    </div>
  </article>
  <article style="border: none;"> </article>
</section>
</body>
</html>
