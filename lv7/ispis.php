<?php
session_start();

// Provjera je li korisnik prijavljen
if (!isset($_SESSION['prijavljen']) || $_SESSION['prijavljen'] != true) {
    header("Location: prijava.php");
    exit();
}

// Spajanje na bazu podataka
include 'spoj.php';

// Upit za dobivanje svih proizvoda iz tablice 'proizvodi'
$sql = "SELECT * FROM proizvodi";
$result = $conn->query($sql);

// Provjera postoji li proizvod
if ($result->num_rows > 0) {
    echo "<h1>Popis proizvoda</h1>";
    echo "<table border='1'>
            <tr>
                <th>Proizvod</th>
                <th>Opis</th>
                <th>Količina</th>
                <th>Cijena</th>
                <th>Akcije</th>
            </tr>";
    
    // Ispis svih proizvoda
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['proizvod'] . "</td>
                <td>" . $row['opis'] . "</td>
                <td>" . $row['kolicina'] . "</td>
                <td>" . $row['cijena'] . "</td>";

        // Ako korisnik ima ulogu 'admin', omogućuje se link za brisanje i uređivanje
        if ($_SESSION['uloga'] == 'admin') {
            echo "<td>
                    <a href='obrisi.php?id=" . $row['id'] . "'>Obriši</a> | 
                    <a href='izmjena.php?id=" . $row['id'] . "'>Uredi</a>
                  </td>";
        } else {
            echo "<td></td>"; // Ako nije admin, ne prikazuje se ništa za akcije
        }

        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "Nema proizvoda u bazi.";
}

$conn->close();
?>

<!-- Ako je korisnik 'admin', prikazuje se link za unos proizvoda -->
<?php if ($_SESSION['uloga'] == 'admin'): ?>
    <p><a href="dodaj_proizvod.php">Unos novog proizvoda</a></p>
<?php endif; ?>

<!-- Linkovi za odjavu -->
<p><a href="odjava.php">Odjava</a></p>