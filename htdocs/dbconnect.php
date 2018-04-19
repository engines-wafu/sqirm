<!-- Server variables for connecting to MySQL -->

<php
$host    = "";
$user    = "";
$pass    = "";
$db_name = "RiskManagement";

// create connection
$db = mysqli_connect($host, $user, $pass, $db_name);

// select hazard
$hazard = "TF001";

// test if connection failed
if(mysqli_connect_errno()){
	die("connection failed: "
		. mysqli_connect_error()
		. " (" . mysqli_connect_errno()
		. ")");
}
?>

<!-- Main html body to be created in index.html -->

<html>
	<head>

<!-- Style data for each element.  This will need to get stripped out into a standaole css file -->

		<style>
        	body {
        		font-family: "Arial";
        	}
        	table, td, body {
        		border-collapse: collapse;
        	}
        	th, tr {
        		border: 1px solid black;
        		border-radius: 1px;
        	}
        	[class*="white"] {
        		background: white;
        	}
        	[class*="green"] {
        		background: green;
        	}
        	[class*="yellow"] {
        		background: yellow;
        	}
        	[class*="red"] {
        		background: red;
        	}
        	#hazard {
        		background: repeating-linear-gradient(45deg, yellow, yellow 4px, #808080 4px, #808080 8px);
        		text-shadow: 1px 1px #808080;
        	}
        </style>
	</head>

<!-- Main content of the webpage gets generated here -->

	<body>
		<h1>Simple Risk Management Tool</h1>

<!-- The page is made up of a 3-column, centre-aligned table that uses 90% of the page width -->

<table style="width:90% border: 0" align="center" >

<!-- Row 1 of the table structure -->

  <tr style="border: 0px">
  <td style="width:450px">
  </td>
  <td style="width:350px">
	<table style="width:80%", id="hazard", align="center">
      <?php
        $qhaz = "SELECT * FROM hazard WHERE hazID='" . $hazard . "'";
        mysqli_query($db, $qhaz) or die('Error querying database.');
        
        $rhaz = mysqli_query($db, $qhaz);
        while ($row = mysqli_fetch_array($rhaz)) {
        	echo '<tr>' . '<td><h2>' . $row['hazID'] . '</h2></td>' . '<td><h2>' . $row['hazDesc'] . '</h2></td>' . '</tr>';
        }
      ?>
	</table>
  </td>
  <td style="width:450px">
  <tr style="border: 0px">
  <td>
	<table style="width:400px" align="center">
	  <tr>
		<th>Threats</th>
		<th>Controls</th>
	  </tr>
<?php
$qthr = "SELECT threat.thrDesc, threat.thrID FROM threat INNER JOIN threat_hazard ON threat_hazard.thrID = threat.thrID WHERE threat_hazard.hazID='" . $hazard . "'";
$rthr = mysqli_query($db, $qthr);
while ($row3 = mysqli_fetch_array($rthr)) {
	echo '<tr>';
	echo '<td>';
	echo $row3['thrDesc'];
	echo '</td>';
	echo '<td>';
	echo '<table>';
	echo '<tr>';
	$qcon = "SELECT controls.conDesc, controls.conWRAG FROM controls INNER JOIN threat_control ON threat_control.conID = controls.conID WHERE threat_control.thrID ='" . $row3['thrID'] . "' AND controls.conActive ='Y'";
	$rcon = mysqli_query($db, $qcon);
	while ($row5 = mysqli_fetch_array($rcon)) {
		echo '<tr>';
		echo '<td class="' . $row5['conWRAG'] . '">';
		echo $row5['conDesc'];
		echo '</td>';
		echo '</tr>';
	}
	echo '</tr>';
	echo '</table>';
	echo '</td>';
	echo '</tr>';
}
?>
	</table>
  </td>
  <td>
	<table style="width:80%" align="center">
	  <tr>
		<th>Top Element</th>
	  </tr>
<?php
$qtop = "SELECT top_element.topDesc FROM hazard INNER JOIN top_element ON top_element.topID = hazard.topID WHERE hazID='" . $hazard . "'";
$rtop = mysqli_query($db, $qtop);
while ($row2 = mysqli_fetch_array($rtop)) {
	echo '<tr>' . '<td>' . $row2['topDesc'] . '</td>' . '</tr>';
}
?>
	</table>
  </td>
  <td>
	<table style="width:400px" align="center">
	  <tr>
		<th>Controls</th>
		<th>Consequence</th>
	  </tr>
<?php
$qcsq = "SELECT consequence.csqDesc, consequence.csqID FROM consequence INNER JOIN hazard_consequence ON consequence.csqID = hazard_consequence.csqID WHERE hazID='" . $hazard . "'";
$rcsq = mysqli_query($db, $qcsq);
while ($row4 = mysqli_fetch_array($rcsq)) {
	echo '<tr>';
	echo '<td>';
	echo '<table>';
	echo '<tr>';
	$qcon2 = "SELECT controls.conDesc, controls.conWRAG FROM controls INNER JOIN consequence_control ON consequence_control.conID = controls.conID WHERE consequence_control.csqID ='" . $row4['csqID'] . "' AND controls.conActive ='Y'";
	$rcon2 = mysqli_query($db, $qcon2);
	while ($row6 = mysqli_fetch_array($rcon2)) {
		echo '<tr>';
		echo '<td class="' . $row6['conWRAG'] . '">';
		echo $row6['conDesc'];
		echo '</td>';
		echo '</tr>';
	}
	echo '</tr>';
	echo '</table>';
	echo '</td>';
	echo '<td>';
	echo $row4['csqDesc'];
	echo '</td>';
	echo '</tr>';
}
?>
	</table>
  </td>
  </tr>
</table>
<?php
mysqli_close($db);
?>
	</body>
</html>
