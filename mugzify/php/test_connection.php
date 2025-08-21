<?php
include 'db_connect.php';

$sql = "SELECT * FROM Reviews LIMIT 5";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "Review ID: " . $row["id"] . " - ReviewScore: " . $row["ReviewScore"] . "<br>";
    }
} else {
    echo "No reviews found.";
}

$conn->close();
?>
