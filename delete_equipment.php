<?php

// Create connection
$conn = new mysqli("localhost", "root", "", "wp");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fetch product ID from POST request
    $product_id = $_POST['product_id'];

    // Delete SQL statement
    $sql = "DELETE FROM equipment WHERE id = $product_id";
    
    // Execute SQL statement for delete
    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("message" => "Equipment deleted successfully"));
    } else {
        echo json_encode(array("error" => "Error: " . $conn->error));
    }
}

// Close connection
$conn->close();
?>
