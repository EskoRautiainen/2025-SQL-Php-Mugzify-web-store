<?php
// Lue tietokannan asetukset .ht.asetukset.ini tiedostosta
$initials = parse_ini_file(".ht.asetukset.ini");

if (!$initials) {
    die("Tietokannan asetuksia ei voitu ladata.");
}

// Yhteyden muodostaminen tietokantaan
$yhteys = mysqli_connect(
    $initials["databaseserver"], 
    $initials["username"], 
    $initials["password"], 
    $initials["database"]
);

// Tarkistetaan, että yhteys onnistui
if (!$yhteys) {
    die("Yhteys tietokantaan epäonnistui: " . mysqli_connect_error());
}
?>
