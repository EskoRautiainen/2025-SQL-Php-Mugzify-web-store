<?php
session_start();

// Tarkistetaan, että admin on kirjautunut
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

// Tarkistetaan, että on CSRF-tokenin validointi
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Tarkistetaan CSRF-token
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("CSRF-tunnistus epäonnistui.");
    }

    // Tarkistetaan, että GET-parametri "id" on asetettu ja se on numeerinen
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        die("Virheellinen käyttäjän ID.");
    }

    $customerID = intval($_GET['id']);

    // Yhteys tietokantaan
    include('db.php');

    // Valmistellaan ja suoritetaan DELETE-kysely
    $query = "DELETE FROM Customer WHERE customerID = ?";
    $stmt = mysqli_prepare($yhteys, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $customerID);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    // Suljetaan tietokantayhteys
    mysqli_close($yhteys);

    // Ohjataan takaisin admin-hallintapaneeliin
    header("Location: admin_dashboard.php");
    exit();
} else {
    // Luo uusi CSRF-token ja talleta se sessioon
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>

<!DOCTYPE html>
<html lang="fi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Poista käyttäjä</title>
</head>
<body>
    <h1>Olet poistamassa käyttäjää</h1>
    <p>Oletko varma, että haluat poistaa tämän käyttäjän? Toimenpide on pysyvä.</p>

    <form method="POST" action="">
        <!-- Piilotettu CSRF-token -->
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

        <button type="submit">Poista käyttäjä</button>
        <a href="admin_dashboard.php">Peruuta</a>
    </form>
</body>
</html>
