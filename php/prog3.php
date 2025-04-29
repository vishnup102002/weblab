<!DOCTYPE html>
<html>
<head>
    <title>Indian Cricket Players</title>
    <style>
        table {
            width: 40%;
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

<?php
// Array of Indian cricket players
$players = array(
    "Virat Kohli",
    "Rohit Sharma",
    "Jasprit Bumrah",
    "KL Rahul",
    "Hardik Pandya",
    "Ravindra Jadeja",
    "Shubman Gill",
    "Suryakumar Yadav",
    "Mohammed Siraj",
    "Rishabh Pant"
);
?>

<h2 style="text-align:center;">Indian Cricket Players</h2>

<table>
    <tr>
        <th>Sl. No</th>
        <th>Player Name</th>
    </tr>
    <?php
    // Display each player in a table row
    foreach ($players as $index => $player) {
        echo "<tr>";
        echo "<td>" . ($index + 1) . "</td>";
        echo "<td>" . $player . "</td>";
        echo "</tr>";
    }
    ?>
</table>

</body>
</html>
