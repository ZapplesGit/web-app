<?php
$servername = "localhost";
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password
$dbname = "gallery_db"; // Replace with your database name

// Create a connection to MySQL
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["image"])) {
    $title = $_POST["title"];
    $description = $_POST["description"];
    $file_name = $_FILES["image"]["name"];
    $file_tmp = $_FILES["image"]["tmp_name"];

    // Move the uploaded image to the server's images folder
    $upload_path = "images/" . $file_name;
    move_uploaded_file($file_tmp, $upload_path);

    // Insert image details into the database
    $sql = "INSERT INTO images (filename, title, description) VALUES ('$file_name', '$title', '$description')";

    if ($conn->query($sql) === TRUE) {
        echo "Image uploaded successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>