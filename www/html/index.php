<?php require('includes/config.php');

//if logged in redirect to members page
if( $user->is_logged_in() ){ header('Location: welcome.php'); exit(); }

//if form has been submitted process it
if(isset($_POST['submit'])){

    if (!isset($_POST['username'])) $error[] = "Please fill out all fields";
    if (!isset($_POST['email'])) $error[] = "Please fill out all fields";
    if (!isset($_POST['password'])) $error[] = "Please fill out all fields";

	$username = $_POST['username'];

	//very basic validation
	if(!$user->isValidUsername($username)){
		$error[] = 'Usernames must be at least 3 Alphanumeric characters';
	} else {
		$stmt = $db->prepare('SELECT username FROM users WHERE username = :username');
		$stmt->execute(array(':username' => $username));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if(!empty($row['username'])){
			$error[] = 'Username provided is already in use.';
		}

	}

	if(strlen($_POST['password']) < 3){
		$error[] = 'Password is too short.';
	}

	if(strlen($_POST['passwordConfirm']) < 3){
		$error[] = 'Confirm password is too short.';
	}

	if($_POST['password'] != $_POST['passwordConfirm']){
		$error[] = 'Passwords do not match.';
	}

	//email validation
	$email = htmlspecialchars_decode($_POST['email'], ENT_QUOTES);
	if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
	    $error[] = 'Please enter a valid email address';
	} else {
		$stmt = $db->prepare('SELECT email FROM users WHERE email = :email');
		$stmt->execute(array(':email' => $email));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if(!empty($row['email'])){
			$error[] = 'Email provided is already in use.';
		}

	}


	//if no errors have been created carry on
	if(!isset($error)){

		//hash the password
		$hashedpassword = $user->password_hash($_POST['password'], PASSWORD_BCRYPT);

		//create the activasion code
		$activasion = md5(uniqid(rand(),true));

		try {

			//insert into database with a prepared statement
			$stmt = $db->prepare('INSERT INTO users (username,password,email,active) VALUES (:username, :password, :email, :active)');
			$stmt->execute(array(
				':username' => $username,
				':password' => $hashedpassword,
				':email' => $email,
				':active' => $activasion
			));
			$id = $db->lastInsertId('userID');

			//send email
			$to = $_POST['email'];
			$subject = "Registration Confirmation";
			$body = "<p>A new user (" . $email . ") has registered on the sqirm site.</p>
			<p>To activate this user's account, please click on this link: <a href='".DIR."activate.php?x=$id&y=$activasion'>".DIR."activate.php?x=$id&y=$activasion</a></p>
			<p>Regards</p>
			<p>Gavin</p>";

			$mail = new Mail();
			$mail->setFrom(SITEEMAIL);
			$mail->addAddress("edwards.gavin@gmail.com");
			$mail->subject($subject);
			$mail->body($body);
			$mail->send();

			//redirect to index page
			header('Location: index.php?action=joined');
			exit;

		//else catch the exception and show the error.
		} catch(PDOException $e) {
		    $error[] = $e->getMessage();
		}

	}

}

//define page title
$title = 'sqirm';

//include header template
require('layout/header.php');
?>

<section style="border:none; background:white;">	
  <article style="border:none;"> </article>
  <article style="border:none;">
    <div class="container">
      <div align=center style="border:none; padding:20px">
        <img src="img/logosm.png" width="150px" align="center" />
		     	<form role="form" method="post" action="" autocomplete="off">
		     	 	<h2>Please Sign Up</h2>
		     	 	<p>Already a member? <a href='login.php'>Login</a></p>
		     	 	<?php
		     	 	//check for any errors
		     	 	if(isset($error)){
		     	 		foreach($error as $error){
		     	 			echo '<p class="bg-danger">'.$error.'</p>';
		     	 		}
		     	 	}
		     	 	//if action is joined show sucess
		     	 	if(isset($_GET['action']) && $_GET['action'] == 'joined'){
		     	 		echo "<h5 class='bg-success'>Registration successful, your request is now being reviewed by an administrator.</h5>";
		     	 	}
		     	 	?>
		     	 	<input type="text" name="username" id="username" class="form-control input-lg" placeholder="User Name" value="<?php if(isset($error)){ echo htmlspecialchars($_POST['username'], ENT_QUOTES); } ?>" tabindex="1">
		     	 	<input type="email" name="email" id="email" class="form-control input-lg" placeholder="Email Address" value="<?php if(isset($error)){ echo htmlspecialchars($_POST['email'], ENT_QUOTES); } ?>" tabindex="2">
     	 			<input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" tabindex="3">
     	 			<input type="password" name="passwordConfirm" id="passwordConfirm" class="form-control input-lg" placeholder="Confirm Password" tabindex="4">
				      <input type="submit" name="submit" value="Register" class="btn btn-primary btn-block btn-lg" tabindex="5">
		     	</form>
      </div>
    </div>
  </article>
  <article style="border: none;">
    <div class="alert">
      <div>
        <h3>
        Disclaimer
        </h3>
        <p>
          <?php include('disclaimer.txt'); ?>
        </p>
      </div>
    </div>
  </article>
</section>

<?php
//include header template
require('layout/footer.php');
?>
