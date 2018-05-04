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
      <canvas id="myChart" width="150px" height="150px"></canvas>
      <script src=Chart.js></script>
      <script>
      var ctx = document.getElementById("myChart");
      var myChart = new Chart(ctx, {
          type: 'doughnut',
          data: {
            labels: ["Red", "Yellow", "Green"],
            datasets: [{
              label: '# of Votes',
              data: [12, 19, 3],
              backgroundColor: [
                'red',
                'yellow',
                'green',
              ],
              borderColor: [
                'red',
                'yellow',
                'green',
              ],
              borderWidth: 1
            }]
          },
          options: {
            scales: { },
            legend: { 
                display: false,
            }
          }
      });

      var chartOptions = {
        rotation: -Math.PI,
        cutoutPercentage: 80,
      }
      </script>
    </div>
  </article>
  <article style="border: none;"> </article>
</section>
</body>
</html>
