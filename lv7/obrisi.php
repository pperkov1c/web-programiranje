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
    
    // SQL upit za brisanje proizvoda
    $sql = "DELETE FROM proizvodi WHERE id = ?";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $id); // 'i' označava da se radi o integer parametru
        if ($stmt->execute()) {
            echo "<p>Proizvod uspješno obrisan!</p>";
        } else {
            echo "<p>Greška pri brisanju proizvoda.</p>";
        }
        $stmt->close();
    } else {
        echo "<p>Greška pri pripremi upita.</p>";
    }
} else {
    echo "<p>ID proizvoda nije naveden.</p>";
}

$conn->close();

echo "<p><a href='ispis.php'>Povratak na popis proizvoda</a></p>";
?>