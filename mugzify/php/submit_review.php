<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $order_id = (int) $_POST['order_id'];
    $customer_id = (int) $_POST['customer_id'];
    $rating = (int) $_POST['rating'];
    $review = $conn->real_escape_string($_POST['review']);
    $imagePath = NULL;

    // Handle file upload
    if (!empty($_FILES['image']['name'])) {
        $targetDir = "uploads/";
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $imageName = basename($_FILES["image"]["name"]);
        $imagePath = $targetDir . time() . "_" . $imageName;

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath)) {
            $imagePath = $conn->real_escape_string($imagePath);
        } else {
            echo "Error uploading image.";
            exit();
        }
    }

    // Insert review into database
    $sql = "INSERT INTO Reviews (Orders_OrderID, Customer_customerID, rating, review, image) 
            VALUES ('$order_id', '$customer_id', '$rating', '$review', '$imagePath')";

    if ($conn->query($sql) === TRUE) {
        echo "Review submitted successfully. <a href='review_form.php'>Submit another</a> or <a href='view_reviews.php'>View Reviews</a>";
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
