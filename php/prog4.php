<!DOCTYPE html>
<html>
<head>
    <title>Student Details</title>
    <style>
        table {
            width: 60%;
            border-collapse: collapse;
            margin: 20px auto;
        }
        th, td {
            padding: 12px;
            border: 1px solid #333;
            text-align: center;
        }
        th {
            background-color: #009688;
            color: white;
        }
    </style>
</head>
<body>

<h2 style="text-align:center;">Student Details</h2>

<?php
// MySQL connection setup
$host = "localhost";
$username = "root";
$password = "root"; 
$database = "php";

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("<p style='text-align:center; color:red;'>Connection failed: " . $conn->connect_error . "</p>");
}

// Query to fetch students
$sql = "SELECT * FROM students";
$result = $conn->query($sql);

// Display data
if ($result->num_rows > 0) {
    echo "<table>
            <tr>
                <th>Sl. No</th>
                <th>Student Name</th>
                <th>Age</th>
                <th>Grade</th>
            </tr>";

    $count = 1;
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $count++ . "</td>
                <td>" . htmlspecialchars($row['name']) . "</td>
                <td>" . $row['age'] . "</td>
                <td>" . $row['grade'] . "</td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "<p style='text-align:center;'>No students found.</p>";
}

$conn->close();
?>

</body>
</html>
