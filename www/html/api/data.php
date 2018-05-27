<?php

//setting header to json
header('Content-Type: application/json');

//database
include "../../inc/dbinfo.inc";

//get connection
$mysqli = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);

if(!$mysqli){
  die("Connection failed: " . $mysqli->error);
}

//query to get data from the table

$query = sprintf("SELECT kpiID, kpiDesc, kpiVal1, kpiVal2, kpiVal3 FROM kpis");

//execute query
$result = $mysqli->query($query);

//loop through the returned data
$data = array();
foreach ($result as $row) {
  $data[] = $row;
}

//free memory associated with result
$result->close();

//close connection
$mysqli->close();

//now print the data
print json_encode($data);
?>
