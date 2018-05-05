<?php
//get kpiID from URL

$kpiNo = $_GET["kpiID"];

//setting header to json
header('Content-Type: application/json');

//database
include "../../inc/dbinfo.inc";

//get connection
$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if(!$mysqli){
	die("Connection failed: " . $mysqli->error);
}

//query to get data from the table
$sql_line = "SELECT kpiDesc, kpiVal1, kpiVal2, kpiVal3 FROM kpis WHERE kpiID = " . $kpiNo;

$query = sprintf($sql_line);

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
