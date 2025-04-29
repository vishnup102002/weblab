<?php
// Store student names in an array
$students = array("John", "Alice", "Michael", "Emma", "David");

// Display original array
echo "Original Array:<br>";
echo "<pre>"; // For better formatting of array output
print_r($students);
echo "</pre>";

// Sort the array in ascending order using asort()
asort($students);
echo "Array Sorted in Ascending Order (asort):<br>";
echo "<pre>";
print_r($students);
echo "</pre>";

// Sort the array in descending order using arsort()
arsort($students);
echo "Array Sorted in Descending Order (arsort):<br>";
echo "<pre>";
print_r($students);
echo "</pre>";
?>
