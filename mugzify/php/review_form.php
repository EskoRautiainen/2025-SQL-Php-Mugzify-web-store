<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mugzify Review</title>
</head>
<body>
    <h2>Submit Your Review</h2>
    <form action="submit_review.php" method="POST" enctype="multipart/form-data">
        <label for="order_id">Order ID:</label>
        <input type="number" name="order_id" required><br><br>

        <label for="customer_id">Customer ID:</label>
        <input type="number" name="customer_id" required><br><br>

        <label for="rating">Rating (1-5):</label>
        <input type="number" name="rating" min="1" max="5" required><br><br>

        <label for="review">Review:</label><br>
        <textarea name="review" rows="4" cols="50" required></textarea><br><br>

        <label for="image">Upload Image (Optional):</label>
        <input type="file" name="image" accept="image/*"><br><br>

        <button type="submit">Submit Review</button>
    </form>
</body>
</html>
