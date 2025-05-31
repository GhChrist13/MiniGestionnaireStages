<?php
// Connexion à la bd
$host = "localhost";
$user = "root";
$password = "";
$dbname = "offre_stage";

$conn = new mysqli($host, $user, $password, $dbname);

// Vérifie la connexion
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}
//Récupération des données du formulaire
$nom_entreprise = $conn->real_escape_string($_POST['nom_entreprise']);
$intitule = $conn->real_escape_string($_POST['intitule_stage']);
$adresse = $conn->real_escape_string($_POST['adresse_entreprise']);
$desc_stage = $conn->real_escape_string($_POST['description']);
$adresse_image = $conn->real_escape_string($_POST['lien_image']);

if ($adresse_image == '') {
    $sql = "INSERT INTO stage (nom_entreprise, intitule_stage, adresse, desc_stage, adresse_image) VALUES ('$nom_entreprise', '$intitule', '$adresse', '$desc_stage' 'https://www.eeb3.eu/app/themes/eeb3/assets/img/layout/child-page-placeholder.png')";
} else {
    $sql = "INSERT INTO stage (nom_entreprise, intitule_stage, adresse, desc_stage, adresse_image) VALUES ('$nom_entreprise', '$intitule', '$adresse', '$desc_stage', '$adresse_image')";
}
$result = $conn->query($sql);

header("Location: tb.php");
exit();

?>