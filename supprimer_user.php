<?php
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id'])) {
    $id = intval($_POST['id']);

    $conn = new mysqli("localhost", "root", "", "utilisateur");
    if ($conn->connect_error) {
        die("Erreur de connexion : " . $conn->connect_error);
    }

    $sql = "DELETE FROM info_utilisateur WHERE id_user = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        echo "OK";
    } else {
        echo "Erreur";
    }

    $stmt->close();
    $conn->close();
}
?>
