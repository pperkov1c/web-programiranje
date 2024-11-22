<?php
if (isset($_GET['ime']) && isset($_GET['prezime'])) {
    $ime = htmlspecialchars($_GET['ime']);
    $prezime = htmlspecialchars($_GET['prezime']);
    echo "<h1>$ime $prezime</h1>";
} else {
    echo "<h1>Dogodila se pogreška</h1>";
}
?>
