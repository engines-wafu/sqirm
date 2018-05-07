<?php include "session.php"; ?>
<?php include "../inc/dbinfo.inc"; ?>
<?php

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
      <!-- notification message -->
      <?php if (isset($_SESSION['success'])) : ?>
      <div>
        <h3>
          <?php 
            echo $_SESSION['success']; 
            unset($_SESSION['success']);
          ?>
        </h3>
        <?php endif ?>
        <!-- logged in user information -->
        <?php  if (isset($_SESSION['username'])) : ?>
        <div>
        <h1>Control Page</h1>
          <p>Logged in as <?php echo $_SESSION['username']; ?> <a href="welcome.php?logout='1'">logout</a> </p>
        </div>
        <?php endif ?>
      </div>
    </div>
    <!-- Main Splash Page Sections -->

    <section>
      <!-- Left division -->
      <article> 
        <div>
          <!-- Get hazards from database -->
          <?php
          		$query = "SELECT * FROM controls WHERE conID='" . $hazard . "'";
            $result = mysqli_query($connection, $query); 
          
            while ($row = mysqli_fetch_array($result)) {
              $conDesc = $row['conDesc'];
              $conActive = $row['conActive'];
              $conWRAG = $row['conWRAG'];
            }
          ?>
          <h2 class=<?php echo $conWRAG; ?>>
            <?php echo $conDesc; ?>
          </h2>
       	  		<form method="post" action="controls.php">
            		<label>Description</label><input type="text" name="descrpition" value="<?php echo $conDesc; ?>"><br />
            		<label>Active</label><input type="checkbox" name="active" <?php if ($conActive = "Y") echo 'checked';?>> <br />
              <input type="radio" name="WRAGradio" value="red" <?php if ($conWRAG = "red") echo 'checked';?>> Red<br>
              <input type="radio" name="WRAGradio" value="amber" <?php if ($conWRAG = "amber") echo 'checked';?>> Amber<br>
              <input type="radio" name="WRAGradio" value="green" <?php if ($conWRAG = "green") echo 'checked';?>> Green<br>
              <input type="radio" name="WRAGradio" value="white" <?php if ($conWRAG = "white") echo 'checked';?>> White<br>
            		<button type="submit" class="btn" name="reg_user">Update</button>
            <?php echo $conWRAG; ?>
       	  		</form>
        </div>
      </article>
    </section>

  </body>
</html>
