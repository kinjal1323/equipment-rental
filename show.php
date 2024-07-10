<?php
    // Create connection
    $conn = new mysqli("localhost", "root", "", "wp");
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Check if product_name is set in the URL
    if(isset($_GET['category'])) {
        // Get the selected product name
        $product_name = $_GET['category'];
    
        // Prepare SQL query based on selected product name
        if ($product_name === 'all') {
            $sql = "SELECT * FROM equipment";
        } else {
            $sql = "SELECT * FROM equipment WHERE product_name='$product_name'";
        }
    
        // Execute SQL query
        $result = $conn->query($sql);
    
        // Check for errors
        if (!$result) {
            die("Error executing query: " . $conn->error);
        }
    
        // Check if there are any rows returned
        if ($result->num_rows > 0) {
            // Output table header
            echo '<body style="background-image: url(\'bg2.jpg\'); background-size: cover;">';
            echo '<h1 align="center">Available Products</h1>';
            echo '<table border="1" align="center" bgcolor="white">';
            echo "<tr>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Rent per Month</th>
                    <th>Available for Months</th>
                    <th>Owner Name</th>
                    <th>Owner Address</th>
                    <th>Owner Contact</th>
                    <th>Equipment Photo</th>
                  </tr>";
    
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['product_name'] . "</td>";
                echo "<td>" . $row['rent_per_month'] . "</td>";
                echo "<td>" . $row['available_for_months'] . "</td>";
                echo "<td>" . $row['owner_name'] . "</td>";
                echo "<td>" . $row['owner_address'] . "</td>";
                echo "<td>" . $row['owner_contact'] . "</td>";
                echo "<td><img src='uploads/" . $row['equipment_photo'] . "' alt='Equipment Photo' style='width: 100px; height: auto;'></td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }
    }
    
    // Close connection
    $conn->close();
    ?>
