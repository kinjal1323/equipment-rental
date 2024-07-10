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
    $product_name = $_POST['product_name'];
    $rent_per_month = $_POST['rent_per_month'];
    $available_for_months = $_POST['available_for_months'];
    $owner_name = $_POST['owner_name'];
    $owner_address = $_POST['owner_address'];
    $owner_contact = $_POST['owner_contact'];
    $equipment_photo = $_FILES['equipment_photo']['name'];

    // Upload image to a directory
    $equipment_photo_path = 'uploads/' . $equipment_photo;
    move_uploaded_file($_FILES['equipment_photo']['tmp_name'], $equipment_photo_path);

    // Prepare SQL statement
    $sql = "INSERT INTO equipment (product_name, rent_per_month, available_for_months, owner_name, owner_address, owner_contact, equipment_photo)
            VALUES ('$product_name', '$rent_per_month', '$available_for_months', '$owner_name', '$owner_address', '$owner_contact', '$equipment_photo')";

    // Execute SQL statement
    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("message" => "Equipment added successfully"));
    } else {
        echo json_encode(array("error" => "Error: " . $sql . "<br>" . $conn->error));
    }
}

// Close connection
$conn->close();
?>
