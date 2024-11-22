<?php
    $student = array("Petra","Perković", "123456789", "3.");
    foreach ($student as $value){
	    echo "$value <br/>";
    }

   $auto = array(
    "Citroen" => array(
        "tip_automobila" => "C4",
        "kubikaža" => 1598,
        "boja" => "crvena",
        "godina_proizvodnje" => 2018,
        "motor" => "benzin"
    ),
    "Mercedes" => array(
        "tip_automobila" => "C-Class",
        "kubikaža" => 2000,
        "boja" => "siva",
        "godina_proizvodnje" => 2007,
        "motor" => "dizel"
    )
);

echo "<br/>";

echo "Elementi niza Citroen:<br>";
foreach ($auto["Citroen"] as $key => $value) {
    echo "$key: $value<br>";
}

echo "<br/>";

echo "Elementi niza Mercedes:<br>";
echo "tip_automobila: " . $auto["Mercedes"]["tip_automobila"] . "<br>";
echo "kubikaža: " . $auto["Mercedes"]["kubikaža"] . "<br>";
echo "boja: " . $auto["Mercedes"]["boja"] . "<br>";
echo "godina_proizvodnje: " . $auto["Mercedes"]["godina_proizvodnje"] . "<br>";
echo "motor: " . $auto["Mercedes"]["motor"] . "<br>";

    function kvadrat($num) {
       return $num * $num;
    }

    $num = 7;
    $result = kvadrat($num);
    echo "<br/>";
    echo "Kvadrat broja $num je: $result";

    class Kupac {
       private $firstName;
       private $lastName;

       public function __construct($firstName, $lastName) {
           $this->firstName = $firstName;
           $this->lastName = $lastName;
       }

       public function setFirstName($firstName) {
           $this->firstName = $firstName;
       }

       public function setLastName($lastName) {
           $this->lastName = $lastName;
       }

       public function printKupacInfo() {
           echo "Kupac je: $this->firstName $this->lastName";
       }
    }
    echo "<br/>";
    echo "<br/>";

    $kupac = new Kupac("Petra", "Perković");

    $kupac->setFirstName("Ana");
    $kupac->setLastName("Novković");

    $kupac->printKupacInfo();

    ?>