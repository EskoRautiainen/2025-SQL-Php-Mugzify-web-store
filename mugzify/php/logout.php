<?php
// Käynnistetään istunto
session_start();

// Tyhjennetään istunto
session_unset();
session_destroy();

// Tarkistetaan, oliko käyttäjä admin
if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true) {
    // Jos käyttäjä on admin, voidaan ohjata hänet admin-sivulle (jos haluat tämän toiminnon)
    header('Location: php/admin_dashboard.php');
} else {
    // Jos käyttäjä on tavallinen asiakas, ohjataan hänet index.php:lle
    header('Location: https://shell.hamk.fi/~trtkp24_17/mugzify/index.php');
}

exit();  // Varmistetaan, ettei mitään muuta koodia suoriteta
?>
