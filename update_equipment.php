<?php

// Create connection
$conn = new mysqli("localhost", "root", "", "wp");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fetch data from POST request
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $rent_per_month = $_POST['rent_per_month'];
    $available_for_months = $_POST['available_for_months'];
    $owner_name = $_POST['owner_name'];
    $owner_address = $_POST['owner_address'];
    $owner_contact = $_POST['owner_contact'];

    // Update SQL statement
    $sql = "UPDATE equipment SET product_name = '$product_name', rent_per_month = '$rent_per_month', available_for_months = '$available_for_months', owner_name = '$owner_name', owner_address = '$owner_address', owner_contact = '$owner_contact' WHERE id = $product_id";
    
    // Execute SQL statement for update
    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("message" => "Equipment updated successfully"));
    } else {
        echo json_encode(array("error" => "Error: " . $conn->error));
    }
}

// Close connection
$conn->close();
?>
