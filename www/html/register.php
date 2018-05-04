<?php include "../inc/dbinfo.inc"; ?>
<html>
  <head>
    <style>
      <?php include "class.css"; ?>
    </style>
  </head>
<body>
<h1>Registration Page</h1>

<?php
// initializing variables
$username = "";
$email    = "";
$errors = array(); 

// connect to the database
$connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($connection, $_POST['username']);
  $email = mysqli_real_escape_string($connection, $_POST['email']);
  $password_1 = mysqli_real_escape_string($connection, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($connection, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...  by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) { array_push($errors, "The two passwords do not match"); }

  // first check the database to make sure a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($connection, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
					echo "THIS SHOULD WORK";
  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
  	mysqli_query($connection, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	// header('location: welcome.php');

  }
}
?>

	<div align = "center">
    <div style = "width:300px; border: solid 3px black; " align = "left">
      <div style = "background-color:black; color:white; padding:10px;"><h2>Register</h2></div>
			<div style = "margin:30px">

        <form method="post" action="register.php">
  	      <label>Username</label><input type="text" name="username" value="<?php echo $username; ?>" class = "box"/><br /><br />
  	      <label>Email</label><input type="email" name="email" value="<?php echo $email; ?>" class = "box"/><br /><br />
  	      <label>Password</label><input type="password" name="password_1" class = "box"/><br /><br />
  	      <label>Confirm password</label><input type="password" name="password_2" class = "box"/><br /><br />
  	      <button type="submit" class="btn" name="reg_user">Register</button>
  			</form>

			  <div style = "font-size:11px; color:#cc0000; margin-top:10px">
				  <?php include('errors.php'); ?>
        </div>
			</div>
	  </div>
	</div>
  	</div>
  	<p>
  		Already a member? <a href="login.php">Sign in</a>
  	</p>
  </form>

</body>
</html>
