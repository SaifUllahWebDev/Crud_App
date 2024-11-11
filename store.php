<?php

require('db.php'); // Assume this connects to the database using mysqli

if (isset($_POST['title']) && isset($_POST['desc'])) {
    $title = $_POST['title'];
    $desc = $_POST['desc'];

    // Prepare the SQL statement with ? placeholders
    $stmt = $conn->prepare("INSERT INTO info (title, description) VALUES (?, ?)");

    // Bind the variables to the placeholders
    $stmt->bind_param("ss", $title, $desc);

    // Execute the prepared statement
    $stmt->execute();

    header('location: index.html');
    
    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Please fill in all fields.";
}
