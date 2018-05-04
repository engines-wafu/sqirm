<html>
  <head>
    <style>
      <?php include "../inc/dbinfo.inc"; ?>
      <?php include "class.css"; ?>
      <?php include "session.php"; ?>
    </style>
  </head>
  <body>
    <div class="content">
      <h1>Welcome Page</h1>
      <!-- notification message -->
      <?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
        <h3>
          <?php 
            echo $_SESSION['success']; 
            unset($_SESSION['success']);
          ?>
        </h3>
      <?php endif ?>
      <!-- logged in user information -->
      <?php  if (isset($_SESSION['username'])) : ?>
      <p>Welcome <?php echo $_SESSION['username']; ?> <a href="welcome.php?logout='1'">logout</a> </p>
      <?php endif ?>
      </div>
    </div>
    <!-- Main Splash Page Sections -->

    <section>
      <!-- Left division -->
      <div> 
        <p>Some text</p>
      </div>

      <!-- Centre division -->
      <div>
        <p>Some text</p>
      </div>

      <!-- Right division -->
      <div>
        <p>Some text</p>
      </div>
    </section>

  </body>
</html>
