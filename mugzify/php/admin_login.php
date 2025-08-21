<?php
// Varmistetaan, että session käynnistetään ennen mitään tulostusta
session_start();

// Yhteys tietokantaan
include('db.php');

// Tarkistetaan, että lomake on lähetetty
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Saadaan sähköposti ja salasana lomakkeelta
    $email = mysqli_real_escape_string($yhteys, $_POST['email']);
    $password = $_POST['password'];

    // Tarkistetaan, että sähköposti ja salasana eivät ole tyhjiä
    if (empty($email) || empty($password)) {
        die("Sähköposti ja salasana eivät voi olla tyhjiä.");
    }

    // Haetaan adminin tiedot tietokannasta
    $query = "SELECT * FROM Admins WHERE Email = '$email'";
    $result = mysqli_query($yhteys, $query);

    if (mysqli_num_rows($result) == 0) {
        die("Admin ei löydy.");
    } else {
        // Haetaan tietokannasta adminin tiedot
        $admin = mysqli_fetch_assoc($result);

        // Tarkistetaan, että salasana täsmää
        if (password_verify($password, $admin['Password'])) {
            // Kirjautuminen onnistui
            $_SESSION['admin_id'] = $admin['AdminID'];
            $_SESSION['admin_email'] = $admin['Email'];


            header('Location: https://shell.hamk.fi/~trtkp24_17/mugzify/php/admin_dashboard.php');
            exit();
            
        } else {
            die("Salasana on väärin.");
        }
    }

    // Suljetaan yhteys
    mysqli_close($yhteys);
}
?>

<!DOCTYPE html>
<html lang="fi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
</head>
<body>

<h2>Admin Login</h2>

<form method="POST" action="">
    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" required><br><br>
    
    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password" required><br><br>

    <input type="submit" value="Kirjaudu">
</form>

</body>
</html>
