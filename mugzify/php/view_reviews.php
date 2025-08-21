<?php
include 'db_connect.php';

$sql = "SELECT * FROM Reviews";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Reviews</title>
</head>
<body>
    <h2>Customer Reviews</h2>

    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div>";
            echo "<p><strong>Order ID:</strong> " . $row["Orders_OrderID"] . "</p>";
            echo "<p><strong>Customer ID:</strong> " . $row["Customer_customerID"] . "</p>";
            echo "<p><strong>Rating:</strong> " . $row["rating"] . "/5</p>";
            echo "<p><strong>Review:</strong> " . $row["review"] . "</p>";

            if (!empty($row["image"])) {
                echo "<img src='" . $row["image"] . "' alt='Review Image' width='200'><br>";
            }

            echo "<a href='admin_delete_review.php?id=" . $row["Orders_OrderID"] . "'>Delete</a>";
            echo "<hr>";
            echo "</div>";
        }
    } else {
        echo "<p>No reviews found.</p>";
    }
    ?>

    <a href="review_form.php">Submit a Review</a>
</body>
</html>

<?php
$conn->close();
?>
