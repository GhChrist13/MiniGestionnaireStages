<?php
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id_stage'])) {
    $id = intval($_POST['id_stage']);
    $nom_entreprise = $_POST['nom_entreprise'] ?? '';
    $intitule = $_POST['intitule_stage'] ?? '';
    $adresse = $_POST['adresse_entreprise'] ?? '';
    $adresse_image = $_POST['lien_image'] ?? '';

    $conn = new mysqli("localhost", "root", "", "offre_stage");
    if ($conn->connect_error) {
        die("Erreur de connexion : " . $conn->connect_error);
    }

    $sql = "UPDATE stage SET nom_entreprise = ?, intitule_stage = ?, adresse = ?, adresse_image = ? WHERE id_stage = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $nom_entreprise, $intitule, $adresse, $adresse_image, $id);

    if ($stmt->execute()) {
        header("Location: tb.php");
        exit();
    } else {
        echo "Erreur lors de la mise à jour.";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Requête invalide.";
}
?>
