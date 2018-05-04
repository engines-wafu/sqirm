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
        <h1>Welcome Page</h1>
        <p>Logged in as <?php echo $_SESSION['username']; ?> <a href="welcome.php?logout='1'">logout</a> </p>
        <?php endif ?>
      </div>
    </div>
    <!-- Main Splash Page Sections -->

    <section>
      <!-- Left division -->
      <article> 
        <div>
          <p>List of active hazards</p>
          <p class="tile_hazard">some hazard</p>
        </div>
      </article>

      <!-- Centre article -->
      <article>
        <div>
          <p>Words in here</p>
        </div>
      </article>

      <!-- Right article -->
      <article>
        <!-- Right top article -->
        <div>
          <p>Words in here</p>
        </div>
        <!-- Right top article -->
        <div>
          <p>Words in here</p>
        </div>
      </article>
    </section>

  </body>
</html>
