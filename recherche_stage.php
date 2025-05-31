<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "offre_stage";

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["key_word"])) {
    $key_word = $_POST["key_word"];

    $sql = "SELECT * FROM stage WHERE nom_entreprise = ? OR intitule_stage = ? OR adresse = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $key_word, $key_word, $key_word);
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
            echo '<button class="voir_offre">Voir l\'offre</button>';
            echo '</div></div>';
        }
    } else {
        echo "<p>Aucun stage trouvé.</p>";
    }

    $stmt->close();
}

$conn->close();
?>