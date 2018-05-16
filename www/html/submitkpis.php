<?php 
include "session.php"; 
include "../inc/dbinfo.inc";

/* Connect to MySQL and select the database. */
$connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);

if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

$database = mysqli_select_db($connection, DB_DATABASE);

$name = $_SESSION['username'];
$date = date('Y-m-d');
$description = $_POST['kpiDesc'];
$kpiID = $_POST['kpiID'];
$val1 = $_POST['kpiVal1'];
$desc1 = $_POST['kpiDesc1'];
$val2 = $_POST['kpiVal2'];
$desc2 = $_POST['kpiDesc2'];
$val3 = $_POST['kpiVal3'];
$desc3 = $_POST['kpiDesc3'];

$sql = 'UPDATE kpis SET kpiDesc = "' . $description . '", kpiDesc1 = "' . $kpiDesc1 . '", kpiVal1 = "' . $kpiVal1 . '", kpiDesc2 = "' . $kpiDesc2 . '", kpiVal2 = "' . $kpiVal2 . '", kpiDesc3 = "' . $kpiDesc3 . '", kpiVal3 = "' . $kpiVal3 . '" WHERE kpiID = "' . $kpiID . '"';

mysqli_query($connection, $sql);

if (mysqli_query($connection, $sql)) {
  echo 'content';
  echo $kpiID . '<br>';
  echo $description . '<br>';
  echo $kpiDesc1 . '<br>';
  echo $kpiVal1 . '<br>';
  echo $kpiDesc2 . '<br>';
  echo $kpiVal2 . '<br>';
  echo $kpiDesc3 . '<br>';
  echo $kpiVal3 . '<br>';
  exit;
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($connection);
}

?>
