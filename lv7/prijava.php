<?php
session_start();
include 'spoj.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $k_ime = $_POST['k_ime'];
    $lozinka = $_POST['lozinka'];

    $sql = "SELECT * FROM korisnici WHERE k_ime = '$k_ime' AND lozinka = '$lozinka'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['prijavljen'] = true;
        $_SESSION['username'] = $row['k_ime'];
        $_SESSION['ime'] = $row['ime'];
        $_SESSION['prezime'] = $row['prezime'];
        $_SESSION['uloga'] = $row['uloga'];

        if ($_SESSION['uloga'] == 'admin') {
            header('Location: dodaj_proizvod.php');
        } else {
            header('Location: ispis.php');
        }
        exit();
    } else {
        echo "<p>Pogrešno korisničko ime ili lozinka.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Prijava</title>
</head>
<body>
    <h1>Prijavite se</h1>
    <form method="POST" action="prijava.php">
        <label for="k_ime">Korisničko ime:</label>
        <input type="text" name="k_ime" required><br><br>
        <label for="lozinka">Lozinka:</label>
        <input type="password" name="lozinka" required><br><br>
        <input type="submit" value="Prijava">
    </form>
</body>
</html>