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
      <?php include "../js/doughnut.js"; ?>
    </div>
  </article>
  <article style="border: none;"> </article>
</section>
</body>
</html>
