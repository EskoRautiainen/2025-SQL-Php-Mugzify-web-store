<?php
session_start();

// Tarkistetaan, että admin on kirjautunut
if (!isset($_SESSION['admin_id']) || !isset($_SESSION['admin_email'])) {
    header('Location: admin_login.php');
    exit();
}

// Tarkistetaan, että id on annettu ja on numeerinen
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Virheellinen käyttäjän ID.");
}

$customerID = intval($_GET['id']);

// Yhteys tietokantaan
include('db.php');

// Haetaan käyttäjän tiedot tietokannasta
$query = "SELECT * FROM Customer WHERE customerID = ?";
$stmt = mysqli_prepare($yhteys, $query);
mysqli_stmt_bind_param($stmt, "i", $customerID);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) == 0) {
    die("Käyttäjää ei löytynyt.");
}

$row = mysqli_fetch_assoc($result);

// CSRF-tokenin tarkistus
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); // Luodaan uusi token
}

// Tarkistetaan, että lomake on lähetetty
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Tarkistetaan CSRF-tokenin oikeellisuus
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("Virheellinen CSRF-token."); // Käyttäjäystävällinen virheilmoitus käyttäjälle.              <<<<-------------------------
    }

    // Saadaan sähköposti lomakkeelta
    $new_email = mysqli_real_escape_string($yhteys, $_POST['email']);
    
    // Tarkistetaan, että sähköposti ei ole tyhjä
    if (empty($new_email)) {
        die("Sähköposti ei voi olla tyhjä.");
    }

    // Päivitetään käyttäjän sähköposti
    $update_query = "UPDATE Customer SET email = ? WHERE customerID = ?";
    $stmt = mysqli_prepare($yhteys, $update_query);
    mysqli_stmt_bind_param($stmt, "si", $new_email, $customerID);
    mysqli_stmt_execute($stmt);

    // Ohjataan takaisin admin-hallintapaneeliin
    header("Location: admin_dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Muokkaa Käyttäjää</title>
</head>
<body>

<h2>Muokkaa Käyttäjää</h2>

<form method="POST" action="">
    <label for="email">Sähköposti:</label><br>
    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" required><br><br>

    <!-- CSRF-token piilotettuna kenttänä -->
    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

    <input type="submit" value="Tallenna muutokset">
</form>

</body>
</html>

<?php
// Suljetaan tietokantayhteys
mysqli_close($yhteys);
?>
