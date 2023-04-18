<?php
require 'index.php';

// Valideer de invoer
$datum = mysqli_real_escape_string($conn, $_POST["datum"]);
$tijd = mysqli_real_escape_string($conn, $_POST["tijd"]);
$locatie = mysqli_real_escape_string($conn, $_POST["locatie"]);
$leerkracht = mysqli_real_escape_string($conn, $_POST["leerkracht"]);

// Controleer of alle velden zijn ingevuld
if (empty($datum) || empty($tijd) || empty($locatie) || empty($leerkracht)) {
    die("Vul alle velden in.");
}

// Controleer of de datum en tijd in de toekomst liggen
$nu = date("Y-m-d H:i:s");
if (strtotime("$datum $tijd") < strtotime($nu)) {
    die("Je kunt geen les plannen in het verleden.");
}

// Controleer of de locatie en leerkracht alleen letters en spaties bevatten
if (!preg_match("/^[a-zA-Z ]*$/", $locatie) || !preg_match("/^[a-zA-Z ]*$/", $leerkracht)) {
    die("Locatie en leerkracht mogen alleen letters en spaties bevatten.");
}

?>