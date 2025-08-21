<?php
// Käynnistetään sessio
session_start();

// Tyhjennetään kaikki session muuttujat
session_unset();

// Tuhoamme session
session_destroy();

// Ohjataan käyttäjä adminin kirjautumissivulle
header('Location: /php/admin_login.php');
exit();
?>
