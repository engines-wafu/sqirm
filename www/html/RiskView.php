<?php include "../inc/dbinfo.inc"; ?>
<?php include "session.php"; ?>
<html>
  <head>
 	<style>
	   <?php include "class.css"; ?>
	 </style>
  </head>
<body>
<h1>Bowtie Viewer</h1>
<?php

/* Connect to MySQL and select the database. */
$connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);

if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

$database = mysqli_select_db($connection, DB_DATABASE);
$hazard = $_GET["hazID"]

?>

<!-- Display table data. -->
<table>
  <tr style="border:0px">
<!-- Column 1 -->
  <td>
  </td>
<!-- Column 2 -->
  <td id="hazard", align="center">
<?php
		$qhaz = "SELECT * FROM hazard WHERE hazID='" . $hazard . "'";
$result = mysqli_query($connection, $qhaz); 

while ($row = mysqli_fetch_array($result)) {
		echo $row['hazID'] . ' ' . $row['hazDesc'];
}
?>
  </td>
<!-- Column 3 -->
  <td>
  </td>
  </tr>
<!-- Row 2 -->
  <tr style="border:0px">
<!-- Column 1 -->
  <td>
	<table>
	<tr>
	  <th>Threats</th>
	  <th>Controls</th>
	</tr>
<?php
$qthr = "SELECT threat.thrDesc, threat.thrID FROM threat INNER JOIN threat_hazard ON threat_hazard.thrID = threat.thrID WHERE threat_hazard.hazID='" . $hazard . "'";
$result1 = mysqli_query($connection, $qthr);
while ($row3 = mysqli_fetch_array($result1)) {
		echo '<tr>';
		echo '<td>';
		echo $row3['thrDesc'];
		echo '</td>';

		echo '<td>';
		echo '<table>';
		echo '<tr>';

		$qcon = "SELECT controls.conDesc, controls.conWRAG FROM controls INNER JOIN threat_control ON threat_control.conID = controls.conID WHERE threat_control.thrID ='" . $row3['thrID'] . "' AND controls.conActive ='Y'";
		$result2 = mysqli_query($connection, $qcon);

		while ($row5 = mysqli_fetch_array($result2)) {
				echo '<tr>';
				echo '<td id="control", class="' . $row5['conWRAG'] . '"><a href="controls.php?conID=' . $row5['conID'] . '">' . $row5['conDesc'] . '</a>';
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
<!-- Column 2 -->
	<td>
	<table>
		<td id="topelement">
<?php
$qtop = "SELECT top_element.topDesc FROM hazard INNER JOIN top_element ON top_element.topID = hazard.topID WHERE hazID='" . $hazard . "'";
$result = mysqli_query($connection, $qtop); 

while ($row = mysqli_fetch_array($result)) {
		echo $row['topDesc'] ;
}
?>
		</td>
	</table>
  </td>
<!-- Column 3 -->
  <td>
	<table>
	<tr>
	  <th id="control">Controls</th>
	  <th>Consequences</th>
	</tr>
<?php
$qcsq = "SELECT consequence.csqDesc, consequence.csqID FROM consequence INNER JOIN hazard_consequence ON consequence.csqID = hazard_consequence.csqID WHERE hazID='" . $hazard . "'";
$result1 = mysqli_query($connection, $qcsq);
while ($row4 = mysqli_fetch_array($result1)) {
		echo '<tr>';
		echo '<td>';
		echo '<table>';
		echo '<tr>';
		$qcon = "SELECT controls.conDesc, controls.conWRAG FROM controls INNER JOIN consequence_control ON consequence_control.conID = controls.conID WHERE consequence_control.csqID ='" . $row4['csqID'] . "' AND controls.conActive ='Y'";
		$result2 = mysqli_query($connection, $qcon);
		while ($row6 = mysqli_fetch_array($result2)) {
				echo '<tr>';
				echo '<td id="control", class="' . $row6['conWRAG'] . '">';
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

<!-- Clean up. -->

<?php

mysqli_free_result($result);
mysqli_close($connection);

?>

</body>
</html>
