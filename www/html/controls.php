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
          <h1>Controls Page</h1>
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
    <!-- Main Splash Page Sections -->
    <section>
      <!-- Left division -->
      <article> 
        <div style="height: 300px">
          <h2>Control Details</h2>
          <?php
          $query = "SELECT * FROM controls WHERE conID='" . $hazard . "'";
          $result = mysqli_query($connection, $query); 
          
          while ($row = mysqli_fetch_array($result)) {
            $conID = $row['conID'];
            $conDesc = $row['conDesc'];
            $conActive = $row['conActive'];
            $conWRAG = $row['conWRAG'];
          }
          ?>
          <p id="pcontrol" class=<?php echo $conWRAG; ?>>
            <b><?php echo $conDesc; ?></b>
          </p>

          <form method="POST" <?php echo 'action="updatecontrol.php?conID=' . $conID . '"' ?>>
            <label>Description</label><input type="text" name="description" size="40" value="<?php echo $conDesc; ?>"/><br>
            <label>Active</label><input type="checkbox" name="active" <?php if ($conActive = "Y") echo 'checked';?>/> <br>
            <input type="radio" name="WRAGradio" value="red" <?php if ($conWRAG == "red") echo 'checked';?>/> Red<br>
            <input type="radio" name="WRAGradio" value="amber" <?php if ($conWRAG == "yellow") echo 'checked';?>/> Amber<br>
            <input type="radio" name="WRAGradio" value="green" <?php if ($conWRAG == "green") echo 'checked';?>/> Green<br>
            <input type="radio" name="WRAGradio" value="white" <?php if ($conWRAG == "white") echo 'checked';?>/> White<br>
            <input type="submit" value="Sumbit"/>
          </form>
        </div>
      </article>
      <!-- Center division -->
      <article> 
        <div>
          <?php
          $query = "SELECT * FROM controls WHERE conID='" . $hazard . "'";
          $result = mysqli_query($connection, $query); 
          
          while ($row = mysqli_fetch_array($result)) {
            $conID = $row['conID'];
            $conDesc = $row['conDesc'];
            $conActive = $row['conActive'];
            $conWRAG = $row['conWRAG'];
          }
          ?>

          <h2>Associated Hazards</h2>

          <!-- Get hazards from database -->
          <?php
          $query = "SELECT DISTINCT hazard.hazID, hazard.hazDesc 
          FROM hazard 
          INNER JOIN threat_hazard 
          ON hazard.hazID=threat_hazard.hazID 
          INNER JOIN threat_control 
          ON threat_hazard.thrID=threat_control.thrID 
          INNER JOIN controls 
          ON threat_control.conID=controls.conID 
          WHERE controls.conID=" . $conID;
          $result = mysqli_query($connection, $query); 
          
          while ($row = mysqli_fetch_array($result)) {
            echo '<p class="tile_hazard"><b><a href="RiskView.php?hazID=' . $row['hazID'] . '">' . $row['hazID'] . ' - ' . $row['hazDesc'] . '</a></b></p>' ;
          }
          ?>

          <h2>Associated Threats and Consequences</h2>

          <!-- Get hazards from database -->
          <?php
          $query = "SELECT DISTINCT threat.thrID, threat.thrDesc 
          FROM threat
          INNER JOIN threat_control 
          ON threat.thrID=threat_control.thrID 
          INNER JOIN controls 
          ON threat_control.conID=controls.conID 
          WHERE controls.conID=" . $conID;
          $result = mysqli_query($connection, $query); 
          
          while ($row = mysqli_fetch_array($result)) {
            echo '<p class="tile_threat"><b>' . $row['thrDesc'] . '</b></p>' ;
          }
          ?>

          <?php
          $query = "SELECT DISTINCT consequence.csqID, consequence.csqDesc 
          FROM consequence
          INNER JOIN consequence_control 
          ON consequence.csqID=consequence_control.csqID 
          INNER JOIN controls 
          ON consequence_control.conID=controls.conID 
          WHERE controls.conID=" . $conID;
          $result = mysqli_query($connection, $query); 
          
          while ($row = mysqli_fetch_array($result)) {
            echo '<p class="tile_consequence"><b>' . $row['csqDesc'] . '</b></p>' ;
          }
          ?>
        </div>
      </article>
      <article>
        <div>
          <div class="cl">
					<form action="addcontrolcomment.php?conID=<?php echo $conID ?>" name="commentControlAdd" method="post">
              <textarea id="comment" class="text" cols="70" rows ="10" name="comment">Insert new comment here.</textarea>
				      <input type="submit" value="Sumbit"/>
            </form>
          </div>
          <?php
          $query = "SELECT DISTINCT comments.* FROM comments INNER JOIN comment_links ON comments.comID=comment_links.comID INNER JOIN controls ON comment_links.conID=controls.conID WHERE controls.conID='" . $conID . "'ORDER BY comments.comID DESC";
          $result = mysqli_query($connection, $query); 
          
          while ($row = mysqli_fetch_array($result)) {
            echo '<div class="cl">';
            echo '<p><b>' . $row['comID'] . ' - </b>' . $row['comment'] .'</p>' ;
            echo '<p><b>By: </b>' . $row['username'] . '<b> on </b>' . $row['date'] .'</p>' ;
            echo '</div>';
          }
          ?>
        </div>
      <!-- Right division -->
      </article> 
    </section>
  </body>
</html>
