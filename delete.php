<?php
require('db.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM info WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: index.php"); // Redirect to the main page
        exit;
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>
