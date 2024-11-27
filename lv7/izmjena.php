<?php
session_start();

// Provjera je li korisnik prijavljen i ima li ulogu 'admin'
if (!isset($_SESSION['prijavljen']) || $_SESSION['prijavljen'] != true || $_SESSION['uloga'] != 'admin') {
    header("Location: prijava.php");
    exit();
}

include 'spoj.php'; // Spajanje na bazu

// Provjera postoji li parametar 'id' u URL-u
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // SQL upit za dohvaćanje podataka proizvoda
    $sql = "SELECT * FROM proizvodi WHERE id = ?";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $product = $result->fetch_assoc();
        
        if (!$product) {
            echo "<p>Proizvod s tim ID-om nije pronađen.</p>";
            exit();
        }
        
        // Ako je obrazac poslan, ažuriraj podatke
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $proizvod = $_POST['proizvod'];
            $opis = $_POST['opis'];
            $kolicina = $_POST['kolicina'];
            $cijena = $_POST['cijena'];
            
            // SQL upit za ažuriranje podataka proizvoda
            $update_sql = "UPDATE proizvodi SET proizvod = ?, opis = ?, kolicina = ?, cijena = ? WHERE id = ?";
            
            if ($update_stmt = $conn->prepare($update_sql)) {
                $update_stmt->bind_param("ssisi", $proizvod, $opis, $kolicina, $cijena, $id);
                if ($update_stmt->execute()) {
                    echo "<p>Proizvod uspješno ažuriran!</p>";
                } else {
                    echo "<p>Greška pri ažuriranju proizvoda.</p>";
                }
                $update_stmt->close();
            }
        }
    }
} else {
    echo "<p>ID proizvoda nije naveden.</p>";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Uredi proizvod</title>
</head>
<body>
    <h1>Uredi proizvod</h1>
    <form method="POST" action="izmjena.php?id=<?php echo $product['id']; ?>">
        <label for="proizvod">Naziv proizvoda:</label><br>
        <input type="text" name="proizvod" value="<?php echo $product['proizvod']; ?>" required><br><br>

        <label for="opis">Opis:</label><br>
        <textarea name="opis" required><?php echo $product['opis']; ?></textarea><br><br>

        <label for="kolicina">Količina:</label><br>
        <input type="number" name="kolicina" value="<?php echo $product['kolicina']; ?>" required><br><br>

        <label for="cijena">Cijena:</label><br>
        <input type="text" name="cijena" value="<?php echo $product['cijena']; ?>" required><br><br>

        <input type="submit" value="Ažuriraj proizvod">
    </form>
    <p><a href="ispis.php">Povratak na popis proizvoda</a></p>
</body>
</html>