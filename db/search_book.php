<?php
// Connect to database
$conn = new mysqli("localhost", "root", "root", "tkm");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$results = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $search_title = $conn->real_escape_string($_POST['search_title']);
    $sql = "SELECT * FROM books WHERE title LIKE '%$search_title%'";
    $res = $conn->query($sql);

    if ($res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            $results[] = $row;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Search Books</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) no-repeat;
            padding: 30px;
            margin: 0;
            height : 100vh;
        }

        h2 {
            color: #444;
            text-align: center;
            margin-bottom: 20px;
        }

        .form-container {
            background: #fff;
            padding: 25px 30px;
            margin-bottom: 30px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            border-radius: 10px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 15px;
        }

        .form-group label {
            margin-bottom: 6px;
            font-weight: bold;
            color: #333;
        }

        input[type="text"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 15px;
            margin-top: 10px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .results-table {
            max-width: 800px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f4f4f4;
        }

        tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Search Book by Title</h2>
        <form method="post">
            <div class="form-group">
                <label>Enter Title:</label>
                <input type="text" name="search_title" required>
            </div>
            <input type="submit" value="Search">
        </form>
    </div>

    <?php if (!empty($results)) { ?>
    <div class="results-table">
        <h2>Search Results</h2>
        <table>
            <thead>
                <tr>
                    <th>Accession No</th>
                    <th>Title</th>
                    <th>Authors</th>
                    <th>Edition</th>
                    <th>Publisher</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($results as $book) { ?>
                    <tr>
                        <td><?php echo $book['accession_number']; ?></td>
                        <td><?php echo $book['title']; ?></td>
                        <td><?php echo $book['authors']; ?></td>
                        <td><?php echo $book['edition']; ?></td>
                        <td><?php echo $book['publisher']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <?php } elseif ($_SERVER["REQUEST_METHOD"] == "POST") { ?>
        <div class="results-table"><p>No results found for your search.</p></div>
    <?php } ?>
</body>
</html>
