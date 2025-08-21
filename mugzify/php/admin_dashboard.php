<?php
// Käynnistetään sessio ja tarkistetaan, että admin on kirjautunut sisään
session_start(); // Käynnistetään sessio

// Tarkistetaan, onko admin kirjautunut sisään
if (!isset($_SESSION['admin_id']) || !isset($_SESSION['admin_email'])) {
    // Jos ei ole kirjautunut sisään, ohjataan takaisin adminin kirjautumissivulle
    header('Location: /php/admin_login.php');
    exit();
}

// Luodaan CSRF-token, jos sitä ei ole vielä
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); // Luodaan uusi token
}

// Yhteys tietokantaan
include('db.php');

// Haetaan kaikki käyttäjät
$query = "SELECT * FROM Customer";
$result = mysqli_query($yhteys, $query);

// Tarkistetaan, onko kysely onnistunut
if (!$result) {
    die("Virhe kyselyssä: " . mysqli_error($yhteys));
}

// Tarkistetaan, onko käyttäjiä olemassa
$user_count = mysqli_num_rows($result);
?>

<!DOCTYPE html>
<html lang="fi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Hallintapaneeli</title>
</head>
<body>

<h1>Tervetuloa, <?php echo htmlspecialchars($_SESSION['admin_email']); ?>!</h1>

<p>Olet nyt kirjautunut sisään admin-hallintapaneeliin.</p>

<h2>Rekisteröityneet käyttäjät</h2>

<?php if ($user_count > 0): ?>
    <table border="1">
        <thead>
            <tr>
                <th>Asiakas ID</th>
                <th>Email</th>
                <th>Toiminnot</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            // Käydään läpi kaikki rivit ja tarkistetaan oikeat kentät
            while ($row = mysqli_fetch_assoc($result)): 
                // Tarkistetaan, että kentät löytyvät
                if(isset($row['customerID']) && isset($row['email'])):
            ?>
            <tr>
                <td><?php echo htmlspecialchars($row['customerID']); ?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td>
                    <!-- Poistolinkki sisältää CSRF-tokenin -->
                    <a href="delete_user.php?id=<?php echo $row['customerID']; ?>&csrf_token=<?php echo $_SESSION['csrf_token']; ?>">Poista</a> |
                    <!-- Muokkauslinkki -->
                    <a href="edit_user.php?id=<?php echo $row['customerID']; ?>">Muokkaa</a>
                </td>
            </tr>
            <?php 
                endif; // End if(isset)
            endwhile; 
            ?>
        </tbody>
    </table>
<?php else: ?>
    <p>Ei rekisteröityjä käyttäjiä.</p>
<?php endif; ?>

<h2>Toiminnot:</h2>
<ul>
    <li><a href="../php/admin_login.php">Kirjaudu ulos</a></li>
</ul>

</body>
</html>

<?php
// Suljetaan yhteys
mysqli_close($yhteys);
?>
