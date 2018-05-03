<?php include "../inc/dbinfo.inc"; ?>
<html>
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
<table style="width:90% border: 1" align="center" >
  <tr style="border: 1px">
  <td style="width:450px">
  </td>
  <td style="width:350px">
	<table style="width:80%", id="hazard", align="center">
      <h2>
      <?php
        $qhaz = "SELECT * FROM hazard WHERE hazID='" . $hazard . "'";
        $result = mysqli_query($connection, $qhaz); 
        
        while ($row = mysqli_fetch_array($result)) {
        	echo $row['hazID'] . '</h2></td>' . '<td><h2>' . $row['hazDesc'];
        }
      ?>
  </td>
  <td style="width:350px">
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
