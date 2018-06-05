<?php
include "session.php";
include "../inc/dbinfo.inc";

/* Connect to MySQL and select the database. */
$connection = mysqli_connect(DBHOST, DBUSER, DBPASS);

if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

$database = mysqli_select_db($connection, DBNAME);
$action = $_GET["actID"];

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
          <h1>Action Detail Page</h1>
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
      <article>
        <div style="overflow:scroll; height:500px">
          <?php
            $query = "SELECT * FROM actions WHERE actID = '" . $action . "'";
            $result = mysqli_query($connection, $query); 
            $row = mysqli_fetch_array($result);
            $ID = $row['actID'];
            $sqaairID = $row['sqaairID'];
            $WRAG = $row['actWRAG'];
            $description = $row['actIssue'];
            $topic = $row['actTopic'];
            $origin = $row['actOrigin'];
            $owner = $row['actOwner'];
            $dl = $row['actDue'];

            echo '<h2 class="tile_action ' . $WRAG . '"> Action Serial Number ' . $action . '</h2>';
          ?>
          <form method="POST" <?php echo 'action="updateaction.php?actID=' . $action . '"' ?>>
          <h3>Description of the Action or Issue</h3>
            <input type="text" name="description" size="40" value="<?php echo $description; ?>"/><br>
          <h3>Owner</h3>
            <input type="text" name="owner" size="40" value="<?php echo $owner; ?>"/><br>
          <h3>WRAG Assessment</h3>
            <input type="radio" name="WRAGradio" value="red" <?php if ($actWRAG == "red") echo 'checked';?>/> Red<br>
            <input type="radio" name="WRAGradio" value="amber" <?php if ($actWRAG == "yellow") echo 'checked';?>/> Amber<br>
            <input type="radio" name="WRAGradio" value="green" <?php if ($actWRAG == "green") echo 'checked';?>/> Green<br>
            <input type="radio" name="WRAGradio" value="white" <?php if ($actWRAG == "white") echo 'checked';?>/> White<br>
          <h3>Topic</h3>
            <input type="text" name="topic" size="40" value="<?php echo $topic; ?>"/><br>
          <h3>Origin</h3>
            <input type="text" name="origin" size="40" value="<?php echo $origin; ?>"/><br>
          <h3>Deadline for rectification</h3>
            <input type="text" name="deadline" size="40" value="<?php echo $dl; ?>"/><br>
            <input type="submit" value="Sumbit"/>
          </form>
        </div>
      </article>
      <article>
        <div style="overflow:scroll; height:500px">
          <h3>Select Associated Primary Control</h3>

          <form method="POST" <?php echo 'action="associatecontrol.php?actID=' . $action . '"' ?>>
            <?php
            $query = "SELECT conPriID FROM actions WHERE actID = " . $action;
            $result = mysqli_query($connection, $query); 
            
            if ($row = mysqli_fetch_array($result)) {
              $conPriID = $row['conPriID'];
            }

            $query = "SELECT conID, conDesc FROM controls";
            $result = mysqli_query($connection, $query); 
            
            while ($row = mysqli_fetch_array($result)) {
              $conID = $row['conID'];
              $conDesc = $row['conDesc'];
              echo '<input type="radio" name="conID" value="' .$conID . '"' . (($conID == $conPriID)?'checked':'') . '/> ' . $conID . ' - ' . $conDesc ;
              echo '<br>';
            }
            ?>
            <input type="submit" value="Associate"/>
          </form>
        </div>
      </article>
      <article>
        <div style="overflow:scroll; height:500px">
        <h3>Comments</h3><hr>
          <?php
          $query = "SELECT DISTINCT comments.* FROM comments INNER JOIN comment_links ON comments.comID=comment_links.comID INNER JOIN actions ON comment_links.actID=actions.actID WHERE actions.actID='" . $action . "'ORDER BY comments.comID DESC";
          $result = mysqli_query($connection, $query); 
          
          while ($row = mysqli_fetch_array($result)) {
            echo '<p>' . $row['comment'] .'</p>' ;
            echo '<p><b>By: </b>' . $row['username'] . '<b> on </b>' . $row['date'] .'</p>' ;
            echo '<hr>' ;
          }
          ?>
          <div class="cl">
            <form action="addactioncomment.php?actID=<?php echo $action ?>" name="commentActionAdd" method="post">
              <textarea id="comment" class="text" cols="70" rows ="10" name="comment">Insert new comment here.</textarea>
              <input type="submit" value="Sumbit"/>
            </form>
          </div>
        </div>
      </article>
    </section>
  </body>
</html>
