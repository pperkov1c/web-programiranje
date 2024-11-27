<?php
session_start();
include 'spoj.php'; // Uključi datoteku koja spaja na bazu podataka

// Provjera je li obrazac poslan
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Preuzimanje podataka iz forme
    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];
    $e_mail = $_POST['e_mail'];
    $k_ime = $_POST['k_ime'];
    $lozinka = $_POST['lozinka'];

    // Zaštita od SQL injekcija
    $k_ime = $conn->real_escape_string($k_ime);
    $lozinka = $conn->real_escape_string($lozinka);
    $ime = $conn->real_escape_string($ime);
    $prezime = $conn->real_escape_string($prezime);
    $e_mail = $conn->real_escape_string($e_mail);

    // Provjera postoji li korisnik s istim korisničkim imenom
    $sql = "SELECT * FROM korisnici WHERE k_ime = '$k_ime'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<p>Korisničko ime već postoji. Pokušajte s drugim.</p>";
    } else {
        // Postavljanje početne uloge kao 'kupac'
        $uloga = 'kupac';
        
        // Unos novog korisnika u bazu
        $sql = "INSERT INTO korisnici (ime, prezime, e_mail, k_ime, lozinka, uloga) 
                VALUES ('$ime', '$prezime', '$e_mail', '$k_ime', '$lozinka', '$uloga')";

        if ($conn->query($sql) === TRUE) {
            echo "<p>Registracija uspješna! Dobrodošli, možete se prijaviti.</p>";
            // Preusmjeravanje na stranicu ispis.php za kupce
            header("Location: ispis.php");
            exit();
        } else {
            echo "<p>Greška pri registraciji: " . $conn->error . "</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Registracija</title>
</head>
<body>
    <h1>Registracija korisnika</h1>
    <form method="POST" action="registracija.php">
        <label for="ime">Ime:</label><br>
        <input type="text" name="ime" required><br><br>

        <label for="prezime">Prezime:</label><br>
        <input type="text" name="prezime" required><br><br>

        <label for="e_mail">E-mail:</label><br>
        <input type="email" name="e_mail" required><br><br>

        <label for="k_ime">Korisničko ime:</label><br>
        <input type="text" name="k_ime" required><br><br>

        <label for="lozinka">Lozinka:</label><br>
        <input type="password" name="lozinka" required><br><br>

        <input type="submit" value="Registriraj se">
    </form>
    <p>Već imate račun? <a href="prijava.php">Prijavite se ovdje</a></p>
</body>
</html>