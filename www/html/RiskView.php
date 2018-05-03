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
<!-- Column 1 -->
  </td>
  <td style="width:350px">
<!-- Column 2 -->
	<table style="width:80%", id="hazard", align="center">
      <h2>
      <?php
        $qhaz = "SELECT * FROM hazard WHERE hazID='" . $hazard . "'";
        $result = mysqli_query($connection, $qhaz); 
        
        while ($row = mysqli_fetch_array($result)) {
        	echo $row['hazID'] . ' ' . $row['hazDesc'];
        }
      ?>
      </h2>
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
    </table>
  </td>
<!-- Column 2 -->
  <td>
Middle column
  </td>
<!-- Column 3 -->
  <td>
    <table>
    <tr>
      <th>Controls</th>
      <th>Consequences</th>
    </tr>
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
