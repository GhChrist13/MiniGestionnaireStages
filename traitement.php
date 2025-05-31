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
$adresse_image = $conn->real_escape_string($_POST['lien_image']);
//Injection
if ($adresse_image == '') {
    $sql = "INSERT INTO stage (nom_entreprise, intitule_stage, adresse, adresse_image) VALUES ('$nom_entreprise', '$intitule', '$adresse', 'https://www.eeb3.eu/app/themes/eeb3/assets/img/layout/child-page-placeholder.png')";
} else {
    $sql = "INSERT INTO stage (nom_entreprise, intitule_stage, adresse, adresse_image) VALUES ('$nom_entreprise', '$intitule', '$adresse', '$adresse_image')";
}
$result = $conn->query($sql);

//Retour à la page principale
header("Location: tb-entreprise.php");
exit();

?>