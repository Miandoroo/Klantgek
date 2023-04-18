<?php 
require 'les_plannen.php';
?>

<form method="POST" action="les_plannen.php">
  <label for="datum">Datum:</label>
  <input type="date" id="datum" name="datum" required><br>

  <label for="tijd">Tijd:</label>
  <input type="time" id="tijd" name="tijd" required><br>

  <label for="locatie">Locatie:</label>
  <input type="text" id="locatie" name="locatie" required><br>

  <label for="leerkracht">Leerkracht:</label>
  <input type="text" id="leerkracht" name="leerkracht" required><br>

  <input type="submit" value="Plan les">
</form>



<?php

// Maak verbinding met de database
$conn = mysqli_connect("localhost", "root", "", "exxx");

// Controleer of de verbinding goed is
if (!$conn) {
    die("Verbinding mislukt: " . mysqli_connect_error());
}

// Controleer of het formulier is ingediend
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Valideer de invoer
    $datum = mysqli_real_escape_string($conn, $_POST["datum"]);
    $tijd = mysqli_real_escape_string($conn, $_POST["tijd"]);
    $locatie = mysqli_real_escape_string($conn, $_POST["locatie"]);
    $leerkracht = mysqli_real_escape_string($conn, $_POST["leerkracht"]);

    // Sla de gegevens op in de database
    $sql = "INSERT INTO lessen (datum, tijd, locatie, leerkracht) VALUES ('$datum', '$tijd', '$locatie', '$leerkracht')";
    if (mysqli_query($conn, $sql)) {
        echo "Les is gepland!";
    } else {
        echo "Er is een fout opgetreden: " . mysqli_error($conn);
    }
}

// Toon de geplande lessen
$sql = "SELECT * FROM lessen";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        echo "Datum: " . $row["datum"]. " - Tijd: " . $row["tijd"]. " - Locatie: " . $row["locatie"]. " - Leerkracht: " . $row["leerkracht"]. "<br>";
    }
} else {
    echo "Er zijn nog geen lessen gepland.";
}

// Sluit de verbinding met de database
mysqli_close($conn);

?>
