<?php
session_start();

// Start output buffering
ob_start();

// Tarkistetaan, onko lomake lähetetty
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Haetaan sähköposti ja salasana lomakkeelta
    $email = $_POST["email"];
    $password = $_POST["salasana"];

    // Tarkistetaan, että molemmat kentät eivät ole tyhjiä
    if (empty($email) || empty($password)) {
        echo "Sähköposti tai salasana ei saa olla tyhjä.";
    } else {
        // Debug: Check if we have the correct inputs
        // echo "Email: $email <br>";
        
        // Yhteyden muodostaminen tietokantaan
        $initials = parse_ini_file(".ht.asetukset.ini");
        if ($initials === false) {
            die("Could not read the configuration file.");
        }
        // Debug: Check if the config file is read correctly
        echo "<pre>";
        print_r($initials);  // Debugging output for database configuration
        echo "</pre>";

        $yhteys = mysqli_connect(
            $initials["databaseserver"],
            $initials["username"],
            $initials["password"],
            $initials["database"]
        );

        if (!$yhteys) {
            die("Yhteys tietokantaan epäonnistui: " . mysqli_connect_error());
        } else {
            echo "Database connected successfully.<br>";  // Debugging output for successful connection
        }

        mysqli_set_charset($yhteys, "utf8");

        // Haetaan käyttäjä tietokannasta sähköpostilla
        $email = mysqli_real_escape_string($yhteys, $email);
        $query = "SELECT * FROM Customer WHERE email = '$email'";
        $result = mysqli_query($yhteys, $query);

        if (!$result) {
            die("Query failed: " . mysqli_error($yhteys)); // Debugging SQL query error
        }

        if (mysqli_num_rows($result) > 0) {
            echo "User found.<br>";  // Debugging output for user found
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row['password'])) {
                echo "Password verified successfully.<br>";  // Debugging output for correct password
                // Salasana on oikein, käyttäjä kirjautui sisään
                $_SESSION['email'] = $email; // Tallennetaan sähköposti istuntoon
                header('Location: ../cart/cart.php');
                exit();  
            } else {
                echo "Password mismatch.<br>";  // Debugging output for incorrect password
            }
        } else {
            echo "User not found.<br>";
        }

        // Suljetaan tietokantayhteys
        mysqli_close($yhteys);
    }
}

// End output buffering and flush the buffer
ob_end_flush();
?>

<link rel="stylesheet" type="text/css" href="auth.css">

<!DOCTYPE html>
<html lang="fi">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kirjautuminen</title>
</head>
<body>
    <form method="POST" action="">
    <h1>Login</h1>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br><br>
        
        <label for="salasana">Password:</label>
        <input type="password" name="salasana" id="salasana" required><br><br>
        
        <button type="submit">Sign in</button>
    </form>
</body>
</html>
