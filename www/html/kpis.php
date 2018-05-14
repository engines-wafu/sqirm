<?php
include "session.php";
include "../inc/dbinfo.inc";
/* Connect to MySQL and select the database. */
$connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();
$database = mysqli_select_db($connection, DB_DATABASE);
$hazard = $_GET["conID"]
?>
<html>
  <head>
    <style>
      <?php include "class.css"; ?>
    </style>
  </head>
  <body>
    <div class="content">
      <div>
        <div class="a">
          <h1>Open Actions Page</h1>
          <?php  if (isset($_SESSION['username'])) : ?>
          <h3>Logged in as <?php echo $_SESSION['username']; ?> <a href="welcome.php?logout='1'">logout</a> </h3>
          <?php endif ?>
        </div>
        <div class="c" width=100px>
          <img src="img/logosm.png" width="100px"/>
        </div>
      </div>
    </div>
    <?php include "navbar.php"; ?>
    <section>
      <article>
        <div>
          <?php
          $query = "SELECT kpiID, kpiDesc FROM kpis";
          $result = mysqli_query($connection, $query); 
          while ($row = mysqli_fetch_array($result)) {
            echo '<div class="cl">';
              echo '<div id="kpiblock">';
                echo '<canvas id="#kpicanvas' . $row['kpiID'] . '" class="kpi"></canvas>';
                echo '<div id="kpititle">' . $row['kpiDesc'] . '</div>';
              echo '</div>';
              echo '<div>';
                echo 'sample text';
              echo '</div>';
            echo '</div>';
          }
          ?>
          <script type="text/javascript" src="js/jquery.js"></script>
          <script type="text/javascript" src="js/Chart.js"></script>
          <script type="text/javascript" src="js/app.js"></script>
        </div>
      </article>
    </section>
  </body>
</html>