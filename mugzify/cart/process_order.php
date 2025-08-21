<?php
session_start(); // Start session

// Read database configuration
$initials = parse_ini_file(".ht.asetukset.ini");
if ($initials === false) {
    die("Could not read the configuration file.");
}

// Database connection
$yhteys = mysqli_connect(
    $initials["databaseserver"],
    $initials["username"],
    $initials["password"],
    $initials["database"]
);

// Check connection
if (!$yhteys) {
    die("Database connection failed.");
}

mysqli_set_charset($yhteys, "utf8");

// Get data from request
$productType = $_POST['productType'] ?? null;
$quantity = $_POST['quantity'] ?? null;
$imageName = $_POST['imageName'] ?? null;
$name = $_POST['name'] ?? null;
$address = $_POST['address'] ?? null;
$postal = $_POST['postal'] ?? null;
$city = $_POST['city'] ?? null;

// Set date and time
$purchaseDate = date("Y-m-d");
$purchaseTime = date("H:i:s");

// Check if user is logged in
$customerID = isset($_SESSION['customerID']) ? $_SESSION['customerID'] : "NULL";

// Insert order into database
$sql = "INSERT INTO Orders (PurchaseDATE, PurchaseTIME, Name, Address, PostalCode, City, PictureID, Customer_customerID) 
        VALUES ('$purchaseDate', '$purchaseTime', '$name', '$address', '$postal', '$city', '$imageName', " . 
        ($customerID !== "NULL" ? "'$customerID'" : "NULL") . ")";

if ($yhteys->query($sql) === TRUE) {
    echo "Order was confirmed.";
} else {
    echo "Error processing order.";
}

// Close connection
$yhteys->close();
?>
