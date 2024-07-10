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
    $product_id = $_POST['product_id']; // Retrieve product ID
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $rental_duration = $_POST['rental_duration'];
    $additional_notes = $_POST['additional_notes'];

    // Prepare SQL statement
    $sql = "INSERT INTO rental_requests (product_id, name, contact, address, rental_duration, additional_notes)
            VALUES ('$product_id', '$name', '$contact', '$address', '$rental_duration', '$additional_notes')";

    // Execute SQL statement
    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("message" => "Rental request submitted successfully"));
    } else {
        echo json_encode(array("error" => "Error: " . $sql . "<br>" . $conn->error));
    }
}

// Close connection
$conn->close();
?>
