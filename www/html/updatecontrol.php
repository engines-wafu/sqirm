          <?php
            $sql = "INSERT INTO controls (conDesc, conActive)
            VALUES ('Stuff in the thing', 'Y')";
            
            if (mysqli_query($connection, $sql)) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($connection);
            }
          ?>
