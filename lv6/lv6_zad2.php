<?php
$filename = "tekst.txt";
$file = fopen($filename, "r+");

$str_tekst = fread($file, filesize($filename));
fclose($file);

echo "<h1>$str_tekst</h1>";

$izrezani_tekst = explode(" ", $str_tekst);

echo "<br/>";
$file = fopen($filename, "a");
foreach ($izrezani_tekst as $rijec) {
    fwrite($file, $rijec . "\n");
}
fclose($file);


echo "<br/>";
$prvoPojavljivanje = strpos($str_tekst, 'k');
$ukupanBrojPojavljivanja = substr_count($str_tekst, 'k');
echo "Prvi put se slovo 'k' pojavljuje na $prvoPojavljivanje mjestu i ukupno se pojavljuje $ukupanBrojPojavljivanja puta.";

?>