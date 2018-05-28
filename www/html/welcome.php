<?php include "session.php";
include "../inc/dbinfo.inc"; 

/* Connect to MySQL and select the database. */
$connection = mysqli_connect(DBHOST, DBUSER, DBPASS);

if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

$database = mysqli_select_db($connection, DBNAME);
$hazard = $_GET["hazID"];
$user = $_SESSION['username'];

$outer_query = "SELECT conID FROM controls;";
$outer_result = mysqli_query($connection, $outer_query); 
while ($outer_row = mysqli_fetch_array($outer_result)) {
  $control = $outer_row['conID'];

  $query = "SELECT kpiPriID FROM controls WHERE conID = " . $control;
  $result = mysqli_query($connection, $query); 
  if ($row = mysqli_fetch_array($result)) {
    $kpiPriID = $row['kpiPriID'];
  }
  
  $query = "SELECT kpiDesc, kpiVal1, kpiVal2, kpiVal3, (kpiVal1 + kpiVal2)/(kpiVal1 + kpiVal2 + kpiVal3) AS kpiWeight FROM kpis WHERE kpiID = " . $kpiPriID;
  $result = mysqli_query($connection, $query); 
  if ($row = mysqli_fetch_array($result)) {
    $k = $row['kpiWeight'];
  } else {
    $k = '1';
  }
  
  $query = "SELECT conwrag, conid FROM controls WHERE conid = " . $control;
  $result = mysqli_query($connection, $query); 
  while ($row = mysqli_fetch_array($result)) {
    if ($row['conwrag'] == 'white') {
      $s = '0';
    } elseif ($row['conwrag'] == 'green') {
      $s = '1';
    } elseif ($row['conwrag'] == 'yellow') {
      $s = '0.5';
    } elseif ($row['conwrag'] == 'red') {
      $s = '0.1';
    }
  }
  
  $query = "SELECT conPriID FROM actions WHERE conPriID =" . $control;
  $result = mysqli_query($connection, $query); 
  if ($row = mysqli_fetch_array($result)) {
    $n_i = mysqli_num_rows($result);
  }
  
  $query = "SELECT actID FROM actions";
  $result = mysqli_query($connection, $query); 
  if ($row = mysqli_fetch_array($result)) {
    $n_t = mysqli_num_rows($result);
  }
  
  $e = $s * $k * (($n_t - $n_i) / $n_t) ;
  
  $query = "SELECT conID FROM consequence_control WHERE conID = " . $control;
  $result = mysqli_query($connection, $query); 
  if ($row = mysqli_fetch_array($result)) {
    $n_cc = mysqli_num_rows($result);
  }
  
  $query = "SELECT conID FROM threat_control WHERE conID = " . $control;
  $result = mysqli_query($connection, $query); 
  if ($row = mysqli_fetch_array($result)) {
    $n_tc = mysqli_num_rows($result);
  }
  
  $query = "SELECT conID FROM threat_control";
  $result = mysqli_query($connection, $query); 
  if ($row = mysqli_fetch_array($result)) {
    $n_ta = mysqli_num_rows($result);
  }
  
  $c = ($n_cc + $n_tc) / $n_ta;
  
  $t = hypot( $c, (1 - $e) );
  
  $query = 'UPDATE controls SET conScore = "' . $t . '" WHERE conID = "' . $control . '"';
  if ($result = mysqli_query($connection, $query)) {; 
  }
}

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
        <!-- logged in user information -->
        <?php  if (isset($_SESSION['username'])) : ?>
        <div style="width: 60%; float:left; border-style:none; padding:0">
          <h1>Welcome Page</h1><br>
          <h3>Logged in as <?php echo $_SESSION['username']; ?> <a href="welcome.php?logout='1'">logout</a> </h3>
        </div>
        <div style="float:right; align:right; border-style:none; padding-right:20">
          <img src="img/logosm.png" width="100px"/>
        </div>
        <?php endif ?>
      </div>
    </div>

    <?php include "navbar.php"; ?>

    <!-- Main Splash Page Sections -->

    <section>
      <!-- Left division -->
      <article> 
        <div style="overflow:scroll; height:500px">
          <h2>List of Active Hazards</h2>
          <!-- get hazards from database -->
          <?php
          $query = "select * from hazard";
          $result = mysqli_query($connection, $query); 
          
          while ($row = mysqli_fetch_array($result)) {
            echo '<p class="tile_hazard"><b><a href="RiskView.php?hazID=' . $row['hazID'] . '">' . $row['hazID'] . ' - ' . $row['hazDesc'] . '</a></b></p>' ;
          }
          ?>
        </div>
      </article>

      <!-- Centre article -->
      <article>
        <div style="overflow:scroll; height:500px">
          <h2>List of Active Controls</h2>
          <!-- Get controls from database -->
          <?php
          $query = "SELECT * FROM controls ORDER BY conScore";
          $result = mysqli_query($connection, $query); 
          
          while ($row = mysqli_fetch_array($result)) {
            echo '<p class="' . $row['conWRAG'] . ' tile_control"><b><a href="controls.php?conID=' . $row['conID'] . '">' . $row['conID'] . ' - ' . $row['conDesc'] . '</a></b></p>' ;
          }
          ?>	
        </div>
      </article>

      <!-- Right article -->
      <article>
        <!-- Right top article -->
        <div style="align-items: flex-start; overflow:scroll; height:136px !important">
          <h2>Key Performance Indicators</h2>

          <?php
          $query = "SELECT kpiID, kpiDesc, kpiVal1, kpiVal2, kpiVal3 FROM kpis ORDER BY kpiVal3/(kpiVal1+kpiVal2+kpiVal3) DESC";
          $result = mysqli_query($connection, $query); 
          while ($row = mysqli_fetch_array($result)) {
            echo '<div id="kpiblock">';
			           echo '<table width="95" style="border: none; table-layout:fixed" align=center><tr width="95" style="border: none"><td>';	
                echo '<canvas vertical-align=top id="#kpicanvas' . $row['kpiID'] . '" class="kpi"></canvas>';
			           echo '</td></tr><tr height="70" style="border: none; background: none !important"><td>';	
                echo '<h3 align=center>' . $row['kpiDesc'] . '</h3>';
			           echo '</td></tr></table>';	
            echo '</div>';
          }
          ?>

          <!-- javascript -->
          <script type="text/javascript" src="js/jquery.js"></script>
          <script type="text/javascript" src="js/Chart.js"></script>
          <script type="text/javascript" src="js/app.js"></script>
        </div>
        <!-- Right top article -->
        <div style="overflow:scroll; height:348px; margin-top:4px">
          <h2>My Actions and Issues</h2>
          <table>
          <?php
            $query = "SELECT actWRAG, actID, actIssue FROM actions WHERE actOwner = '" . $user . "'";
            $result = mysqli_query($connection, $query); 
            while ($row = mysqli_fetch_array($result)) {
              $ID = $row['actID'];
              $WRAG = $row['actWRAG'];
              $description = $row['actIssue'];
              $owner = $row['actOwner'];
              echo '<p class="tile_action ' . $WRAG . '"><b><a href="action.php?actID=' . $ID . '">' . $ID . ' - ' . $description . '</a></b></p>' ;
            }
          ?>
          </table>
        </div>
      </article>
    </section>
  </body>
</html>
