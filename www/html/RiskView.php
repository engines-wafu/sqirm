<?php include "../inc/dbinfo.inc"; ?>
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
  $hazard = "HF001";

?>

<!-- Display table data. -->
<table>
  <tr style="border:0px">
  <td style="width:450px">
<!-- Column 1 -->
  </td>
  <td style="width:350px">
<!-- Column 2 -->
	<table style="width:80%", id="hazard", align="center">
      <?php
        $qhaz = "SELECT * FROM hazard WHERE hazID='" . $hazard . "'";
        $result = mysqli_query($connection, $qhaz); 
        
        while ($row = mysqli_fetch_array($result)) {
          echo $row['hazID'] . ' ' . $row['hazDesc'];
        }
      ?>
    </table>
  </td>
  <td style="width:350px">
<!-- Column 3 -->
  </td>
  </tr>
<!-- Row 2 -->
  <tr>
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
<!-- Column 2 -->
  <td>
    <?php
      $qtop = "SELECT top_element.topDesc FROM hazard INNER JOIN top_element ON top_element.topID = hazard.topID WHERE hazID='" . $hazard . "'";
      $result = mysqli_query($connection, $qtop); 
      
      while ($row = mysqli_fetch_array($result)) {
      	echo $row['topDesc'] ;
      }
    ?>
  </td>
<!-- Column 3 -->
  <td>
    <table>
    <tr>
      <th>Controls</th>
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

<!-- Clean up. -->

<?php

  mysqli_free_result($result);
  mysqli_close($connection);

?>

</body>
</html>
