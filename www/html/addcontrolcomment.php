<?php 
include "session.php"; 
include "../inc/dbinfo.inc";

/* Connect to MySQL and select the database. */
$connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);

if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

$database = mysqli_select_db($connection, DB_DATABASE);

$control = $_GET["conID"];
$name = $_SESSION['username'];
$date = date();
$comment = $_POST['comment'];

$sql = "INSERT INTO comments (comment, username, active, date) VALUES ('" . $comment . "', '" . $name . "', '1', '" . $date "')";

if (mysqli_query($connection, $sql)) {
  echo var_dump($_POST);
  echo "Comment added";
  header('Location: controls.php?conID=' . $control);
  exit;
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($connection);
}

?>