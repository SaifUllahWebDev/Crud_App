<?php
require('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    $sql = "UPDATE info SET title=?, description=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $title, $description, $id);

    if ($stmt->execute()) {
        header("Location: index.php"); // Redirect to the main page
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else {
    $id = $_GET['id'];
    $sql = "SELECT * FROM info WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Note</title>
</head>
<style>
    body {
        background: radial-gradient(circle, #f2f2f2, #e0e0e0);
        font-family: 'Arial', sans-serif;
        color: #333;
        margin: 0;
        padding: 0;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .container {
        max-width: 600px;
        width: 100%;
        background: #ffffff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    h2 {
        text-align: center;
        font-size: 24px;
        font-weight: bold;
        color: #4a4a4a;
        margin-bottom: 20px;
        text-transform: uppercase;
    }

    .form-label {
        font-weight: bold;
        font-size: 14px;
        color: #555;
        margin-bottom: 8px;
    }

    .form-control {
        width: 100%;
        padding: 10px 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background: #f9f9f9;
        font-size: 14px;
        color: #555;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 6px rgba(0, 123, 255, 0.3);
        outline: none;
    }

    textarea.form-control {
        resize: none;
        height: 120px;
    }

    .btn-primary {
        display: block;
        width: 100%;
        padding: 12px;
        font-size: 16px;
        font-weight: bold;
        text-transform: uppercase;
        background: #007bff;
        color: #fff;
        border: none;
        border-radius: 8px;
        margin-top: 15px;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        transform: translateY(-2px);
        box-shadow: 0 8px 15px rgba(0, 91, 179, 0.4);
    }

    .btn-primary:active {
        transform: translateY(1px);
        box-shadow: none;
    }

    .btn-primary:focus {
        outline: none;
        box-shadow: 0 0 8px rgba(0, 123, 255, 0.5);
    }

    @media (max-width: 768px) {
        .container {
            padding: 20px;
        }

        h2 {
            font-size: 20px;
        }
    }
</style>

<body>
    <div class="container my-5">
        <h2>Edit Note</h2>
        <form action="edit.php" method="post">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($row['title']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required><?php echo htmlspecialchars($row['description']); ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>

</html>