<?php
error_reporting(E_ALL); ini_set('display_errors', 'On');
include "../inc/dbinfo.inc"; 
session_start();
?>
<html>
	<head>
		<style>
<?php
ob_start();
include "class.css";
include "server.php"
ob_end_flush();
?>
		</style>
	</head>
<body>
<section style="border:none; background:white">
	<article style="border:none;"> </article>
	<article style="width:400px;";>
		<div class="container">
			<div align=center style="border:none; padding-bottom:20px">
				<img src="img/logosm.png" width="150px" align="center" />
			</div>
			<form action="" method="post">
				<div class="ll">
					<h4>
						Name
					</h4>
				</div>
				<div class="li">
					<input type="text" name="username"> <br />
				</div>
				<div class="ll">
					<h4>
						Password
					</h4>
				</div>
				<div class="li">
					<input type="password" name="password"> <br />
				</div>
				<button type="submit" class="btn" name="login_user">Login</button> <br />
				<p> <a href="register.php">Sign up</a> </p>
			</form>
<?php
include('errors.php');
?>
		</div>
	</article>
	<article style="border: none;"> 
		<div class="alert">
			<div>
				<h3>
				Disclaimer 
				</h3>
				<p>
<?php
include('disclaimer.txt');
?>
				</p>
			</div>
		</div>
	</article>
</section>
</body>
</html>
