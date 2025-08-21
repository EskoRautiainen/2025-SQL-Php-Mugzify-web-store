<?php
// Tarkistetaan, onko lomake lähetetty
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Haetaan sähköposti ja salasana lomakkeelta
    $email = $_POST["email"];
    $password = $_POST["salasana"];

    // Tarkistetaan, että molemmat kentät eivät ole tyhjiä
    if (empty($email) || empty($password)) {
        echo '<div class="error-message">Sähköposti tai salasana ei saa olla tyhjä.</div>';
    } else {
        // Tarkistetaan, että sähköpostiosoite on oikeassa muodossa
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo '<div class="error-message">Sähköpostiosoite ei ole kelvollinen.</div>';
        } else {
            // Tietokannan asetukset (muokkaa tarvittaessa)
            $initials = parse_ini_file(".ht.asetukset.ini");

            // Yhteyden muodostaminen tietokantaan
            $yhteys = mysqli_connect(
                $initials["databaseserver"],
                $initials["username"],
                $initials["password"],
                $initials["database"]
            );

            if (!$yhteys) {
                die('<div class="error-message">Yhteys tietokantaan epäonnistui: ' . mysqli_connect_error() . '</div>');
            }

            // Asetetaan yhteys käyttämään UTF-8-merkistöä
            mysqli_set_charset($yhteys, "utf8");

            // Tarkistetaan, onko sähköpostiosoite jo käytössä
            $email = mysqli_real_escape_string($yhteys, $email);
            $query = "SELECT * FROM Customer WHERE email = '$email'";
            $result = mysqli_query($yhteys, $query);

            if (mysqli_num_rows($result) > 0) {
                echo '<div class="error-message">Sähköposti on jo käytössä.</div>';
            } else {
                // Salasanan hash-kaava ennen tallentamista
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                // Lisää käyttäjä tietokantaan
                $insert_query = "INSERT INTO Customer (email, password) VALUES ('$email', '$hashed_password')";
                if (mysqli_query($yhteys, $insert_query)) {
                    echo '<div class="success-message">Rekisteröinti onnistui!</div>';
                } else {
                    echo '<div class="error-message">Virhe rekisteröinnissä: ' . mysqli_error($yhteys) . '</div>';
                }
            }

            // Suljetaan tietokantayhteys
            mysqli_close($yhteys);
        }
    }
}
?>


<link rel="stylesheet" type="text/css" href="auth.css">

<!DOCTYPE html>
<html lang="fi">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
</head>
<body>
    <form method="POST" action="">
        <h1>Registration</h1>

        <!-- Display error or success messages -->
        <?php if (!empty($message)) { echo $message; } ?>
        
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br><br>

        <label for="salasana">Password:</label>
        <input type="password" name="salasana" id="salasana" required><br><br>

        <button type="submit">Register</button>
    </form>
</body>
</html>
