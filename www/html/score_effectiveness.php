<?php

include "session.php";
include "../inc/dbinfo.inc";

$connection = mysqli_connect(DBHOST, DBUSER, DBPASS);
if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();
$database = mysqli_select_db($connection, DBNAME);
$control = $_GET["conID"]


$query = "SELECT kpiVal1, kpiVal2, kpiVal3, calc AS kpiVal3/(kpiVal1+kpiVal2+kpiVal3) FROM kpis WHERE kpiID=1";
$result = mysqli_query($connection, $query); 
while ($row = mysqli_fetch_array($result)) {
  echo $row['kpiID'];
}

?>
