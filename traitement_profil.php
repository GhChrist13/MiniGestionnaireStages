<?php

$host = "localhost";
$user = "root";
$password = "";
$dbname = "utilisateur";

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die(json_encode(["success" => false, "error" => "Connexion échouée."]));
}

if (isset($_POST["email"]) && isset($_POST["password"])) {
    $email = $conn->real_escape_string($_POST["email"]);
    $password = $conn->real_escape_string($_POST["password"]);

    $stmt = $conn->prepare("SELECT nom, prenom, email, roleU FROM info_utilisateur WHERE email = ? AND mot_de_passe = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode([
            "success" => true,
            "nom" => $row["nom"],
            "prenom" => $row["prenom"],
            "email" => $row["email"],
            "roleU" => $row["roleU"]
        ]);
    } else {
        echo json_encode(["success" => false]);
    }

    $stmt->close();
} else {
    echo json_encode(["success" => false, "error" => "Données manquantes."]);
}

$conn->close();
?>