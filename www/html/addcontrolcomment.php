<?php 
include "session.php"; 
include "../inc/dbinfo.inc";

/* Connect to MySQL and select the database. */
$connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);

if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

$database = mysqli_select_db($connection, DB_DATABASE);

$control = $_GET["conID"];
$desc = $_POST['description'];
$name = $_SESSION['username'];
$date = date();
$comment = $_POST['comment'];

$sql = "INSERT INTO comments (comment, username, active, date) VALUES ('" . $comment . "', " . $name . "', 1, '" . $date "')";

mysqli_query($connection, $sql);

?>
