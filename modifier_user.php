<?php
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id_stage'])) {
    $id = intval($_POST['id_user']);
    $nom = $_POST['nom'] ?? '';
    $prenom = $_POST['prenom'] ?? '';
    $email = $_POST['email'] ?? '';
    $roleU = $_POST['roleU'] ?? '';

    $conn = new mysqli("localhost", "root", "", "offre_stage");
    if ($conn->connect_error) {
        die("Erreur de connexion : " . $conn->connect_error);
    }

    $sql = "UPDATE stage SET nom = ?, prenom = ?, email = ?, roleU = ? WHERE id_user = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $nom, $prenom, $email, $roleU, $id);

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
