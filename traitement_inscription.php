<?php

$host = "localhost";
$user = "root";
$password = "";
$dbname = "utilisateur";

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Erreur de connexion" . $conn->connect_error);
}

if (isset($_POST["lastname"]) && isset($_POST["firstname"]) && isset($_POST["email"]) && isset($_POST["role"]) && isset($_POST["password"]) && isset($_POST["passwordConfirm"])) {
    $lastname = $conn->real_escape_string($_POST["lastname"]);
    $firstname = $conn->real_escape_string($_POST["firstname"]);
    $email = $conn->real_escape_string($_POST["email"]);
    $role = $conn->real_escape_string($_POST["role"]);
    $password = $conn->real_escape_string($_POST["password"]);
    $passwordConfirm = $conn->real_escape_string($_POST["passwordConfirm"]);

    $sql = "INSERT INTO info_utilisateur (nom, prenom, email, mot_de_passe, roleU) VALUES ('$lastname', '$firstname', '$email', '$password', '$role')";
    $result = $conn->query($sql);
}

header("Location: http://localhost/gestionnaireStages/connexion.php");
exit();

?>