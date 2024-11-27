<?php
session_start();

// Provjera je li korisnik prijavljen
if (!isset($_SESSION['prijavljen']) || $_SESSION['prijavljen'] != true) {
    header("Location: prijava.php");
    exit();
}

// Provjera ima li korisnik ulogu admin
if ($_SESSION['uloga'] != 'admin') {
    header("Location: ispis.php"); // Ako nije admin, preusmjeri ga na ispis proizvoda
    exit();
}
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Dodaj proizvod</title>
</head>
<body>
    <h1>Dodaj proizvod</h1>
    <!-- Forma za unos proizvoda -->
    <form method="POST" action="unos.php">
        <label for="proizvod">Naziv proizvoda:</label><br>
        <input type="text" name="proizvod" required><br><br>

        <label for="opis">Opis:</label><br>
        <textarea name="opis" required></textarea><br><br>

        <label for="kolicina">Količina:</label><br>
        <input type="number" name="kolicina" required><br><br>

        <label for="cijena">Cijena:</label><br>
        <input type="text" name="cijena" required><br><br>

        <input type="submit" value="Unesi proizvod">
    </form>

    <p><a href="ispis.php">Povratak na ispis proizvoda</a></p>
</body>
</html>