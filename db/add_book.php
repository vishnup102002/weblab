<?php
// Database connection
$conn = new mysqli("localhost", "root", "root", "tkm");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get POST data
$accession = $_POST['accession_number'];
$title = $_POST['title'];
$authors = $_POST['authors'];
$edition = $_POST['edition'];
$publisher = $_POST['publisher'];

// Insert query
$sql = "INSERT INTO books (accession_number, title, authors, edition, publisher)
        VALUES ('$accession', '$title', '$authors', '$edition', '$publisher')";

if ($conn->query($sql) === TRUE) {
    // Redirect back to form with success flag
    header("Location: book_form.html?success=1");
    exit();
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
