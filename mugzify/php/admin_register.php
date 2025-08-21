<?php
// Yhteys tietokantaan omalla db.php tiedostolla
include('db.php');  // Oletetaan, että tämä tiedosto luo yhteyden tietokantaan

// Käynnistetään sessio, jos ei ole vielä käynnistetty
session_start();

// Tarkistetaan, että lomake on lähetetty
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Tarkistetaan CSRF-tokenin oikeellisuus
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("Virheellinen CSRF-token.");
    }

    // Saadaan sähköposti ja salasana lomakkeelta
    $email = mysqli_real_escape_string($yhteys, $_POST['email']);
    $password = $_POST['password'];

    // Tarkistetaan, että sähköposti ja salasana eivät ole tyhjiä
    if (empty($email) || empty($password)) {
        die("Sähköposti ja salasana eivät voi olla tyhjiä.");
    }

    // Tarkistetaan, että sähköposti ei ole jo käytössä
    $query = "SELECT * FROM Admins WHERE Email = '$email'";
    $result = mysqli_query($yhteys, $query);

    if (mysqli_num_rows($result) > 0) {
        die("Sähköposti on jo käytössä.");
    }

    // Suolataan ja hashataan salasana
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Lisätään uusi admin-tunnus tietokantaan
    $insert_query = "INSERT INTO Admins (Email, Password) VALUES ('$email', '$hashed_password')";
    
    if (mysqli_query($yhteys, $insert_query)) {
        echo "Admin-käyttäjä rekisteröity onnistuneesti.";
    } else {
        die("Virhe rekisteröinnissä: " . mysqli_error($yhteys));
    }
    
    // Suljetaan tietokantayhteys
    mysqli_close($yhteys);
}

// Luodaan CSRF-token, jos sitä ei ole jo olemassa
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); // Luodaan uusi token
}
?>

<!DOCTYPE html>
<html lang="fi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Rekisteröinti</title>
</head>
<body>

<h2>Admin Rekisteröinti</h2>

<!-- Rekisteröintilomake -->
<form method="POST" action="">
    <label for="email">Sähköposti:</label><br>
    <input type="email" id="email" name="email" required><br><br>
    
    <label for="password">Salasana:</label><br>
    <input type="password" id="password" name="password" required><br><br>

    <!-- Lisätään CSRF-token piilotettuna kenttänä -->
    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

    <input type="submit" value="Rekisteröidy">
</form>

</body>
</html>
