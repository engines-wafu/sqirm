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
<?php

  /* Connect to MySQL and select the database. */
  $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
  
  if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();
  
  $database = mysqli_select_db($connection, DB_DATABASE);
  
  $kpititle = "myChart";
  
  $query = "SELECT * FROM kpis";
  $result = mysqli_query($connection, $query);

?>
<section>
  <article style="border: none;"> </article>
  <article>
    <div>
      <p>
        <?php
          while ($row = mysqli_fetch_array($result)) {
            echo $row['kpiDesc'];
          }
        ?
      </p>
      <canvas id="myChart" width="150" height="150"></canvas>
      <script src=../js/Chart.js></script>
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
      </script>
    </div>
  </article>
  <article style="border: none;"> </article>
</section>
</body>
</html>
