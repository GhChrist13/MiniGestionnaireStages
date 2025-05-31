<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "offre_stage";

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["nomFiltre"])) {
    $nomFiltre = $_POST["nomFiltre"];

    if ($nomFiltre === "TOUS") {
        $sql = "SELECT * FROM stage";
        $stmt = $conn->prepare($sql);
    } else {
        $sql = "SELECT * FROM stage WHERE nom_entreprise = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $nomFiltre);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="stages">';
            echo '<div class="images" style="background-image: url(' . htmlspecialchars($row["adresse_image"]) . ');"></div>';
            echo '<div class="desc">';
            echo '<h2>' . htmlspecialchars($row["intitule_stage"]) . '</h2>';
            echo '<h5>' . htmlspecialchars($row["adresse"]) . '</h5>';
            echo '<h6 translate="no">Stage</h6>';
            echo '<span><i class="fa-solid fa-heart"></i></span>';
            echo '<button>Voir l\'offre</button>';
            echo '</div></div>';
        }
    } else {
        echo "<p>Aucun stage trouvé pour cette entreprise.</p>";
    }

    $stmt->close();
}

$conn->close();
?>