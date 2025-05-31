<?php

$host = "localhost";
$user = "root";
$password = "";
$dbname = "utilisateur";

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}


if (isset($_POST["email"]) && isset($_POST["password"])) {
    $email = $conn->real_escape_string($_POST["email"]);
    $password = $conn->real_escape_string($_POST["password"]);

    $sql = "SELECT * FROM info_utilisateur WHERE email = '$email' AND mot_de_passe = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if ($row["roleU"] == "ADMIN") {
            header("Location: http://localhost/gestionnaireStages/index.php");
            exit();
        } elseif ($row["roleU"] == "CLIENT") {
            header("Location: http://localhost/GS-côteClient/index.php");
            exit();
        }
    } else {
        header("Location: connexion.html?erreur=1");
        exit();
    }
} else {
    header("Location: connexion.html?erreur=2");
    exit();
}

$conn->close();
?>