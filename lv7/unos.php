<?php
session_start();
if (!isset($_SESSION['prijavljen']) || $_SESSION['prijavljen'] != true) {
    header("Location: prijava.php");
    exit();
}
include 'spoj.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $proizvod = $_POST['proizvod'];
    $opis = $_POST['opis'];
    $kolicina = $_POST['kolicina'];
    $cijena = $_POST['cijena'];

    $sql = "INSERT INTO proizvodi (proizvod, opis, kolicina, cijena) VALUES ('$proizvod', '$opis', '$kolicina', '$cijena')";
    if ($conn->query($sql) === TRUE) {
        echo "<p>Proizvod uspješno unesen!</p>";
        echo "<p><a href='dodaj_proizvod.php'>Povratak na unos proizvoda</a></p>";
        echo "<p><a href='ispis.php'>Ispis svih proizvoda</a></p>";
    } else {
        echo "<p>Greška: " . $conn->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Unos proizvoda</title>
</head>
<body>
    <h1>Unos proizvoda</h1>
    <form method="POST" action="unos.php">
        <label for="proizvod">Proizvod:</label><br>
        <input type="text" name="proizvod" required><br><br>

        <label for="opis">Opis:</label><br>
        <textarea name="opis" required></textarea><br><br>

        <label for="kolicina">Količina:</label><br>
        <input type="number" name="kolicina" required><br><br>

        <label for="cijena">Cijena:</label><br>
        <input type="text" name="cijena" required><br><br>

        <input type="submit" value="Unesi proizvod">
    </form>
</body>
</html>