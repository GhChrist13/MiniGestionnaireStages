<!-- Récupération des données de la BD -->


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

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="tb.css">
    <title>Gestionnaire de stages</title>
</head>

<body>

    <!-- Entête de la page============================================-->
    <header>

    </header>

    <!-- Corps de page============================================== -->


    <!-- contain========================================================================= -->

    <div class="contain">

        <!-- Block central========================= -->
        <div class="central-block">

            <!-- Tableau de bord =========================================-->



            <h1>Tableau de bord/ Admin</h1>

            <table translate="no">
                <thead>
                    <tr>
                        <th>ID_stages</th>
                        <th>Nom_entreprise</th>
                        <th>Adresse</th>
                        <th>Intitulé du stage</th>
                        <th>Adresse image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    <!-- Récupération des données de la bd -->
                    <?php
                    $sql = "SELECT * FROM stage";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo "" . $row["id_stage"] ?></td>
                            <td style="max-width: 100px;"><?php echo "" . $row["nom_entreprise"] ?></td>
                            <td><?php echo "" . $row["adresse"] ?></td>
                            <td><?php echo "" . $row["intitule_stage"] ?></td>
                            <td style="max-width: 150px;"><?php echo "" . $row["adresse_image"] ?></td>
                            <td style="max-width: 120px; text-align: right;">
                                <button class="btn btn-modifier" translate="no">Modifier</button>
                                <button class="btn btn-supprimer"
                                    data-id="<?php echo $row["id_stage"]; ?>">Supprimer</button>

                            </td>
                        </tr>
                        <?php
                    }
                    ?>

                </tbody>
            </table>

            <!-- Formulaire d'ajout d'offre -->

            <div class="overlay" translate="no">
                <div class="form_contain">

                    <h2 translate="no">Ajouter un Stage</h2>

                    <form action="traitement.php" method="POST">
                        <input type="text" name="nom_entreprise" placeholder="Nom de l'entreprise" required>
                        <input type="text" name="intitule_stage" placeholder="Intitulé du stage" required>
                        <input type="text" name="adresse_entreprise" placeholder="Adresse de l'entreprise">
                        <input type="url" name="lien_image" placeholder="Lien de l'image">
                        <input type="hidden" name="id_stage" value="">
                        <div class="form-buttons">
                            <button type="button" class="btn-annuler">Annuler</button>
                            <button type="submit" class="btn-envoyer">Envoyer</button>
                        </div>
                    </form>

                </div>
            </div>


        </div>

        <!-- Barre latérale======================== -->
        <div class="side">
            <div class="side-icons">
                <div class="side-item">
                    <i class="fa-solid fa-bars" id="barre"></i><span class="hidden-desc">Menu</span>
                </div>
                <div class="side-item" id="accueil">
                    <i class="fa-solid fa-house"></i><span class="hidden-desc">Accueil</span>
                </div>
                <div class="side-item" id="table_bord">
                    <i class="fa-solid fa-table-list"></i><span class="hidden-desc">Tableau de bord</span>
                </div>
                <div class="side-item" id="ajout_stage">
                    <i class="fa-solid fa-plus"></i><span class="hidden-desc">Ajouter une offre</span>
                </div>
                <div class="side-item">
                    <i class="fa-solid fa-heart"></i><span class="hidden-desc">Favoris</span>
                </div>
            </div>
        </div>


        <!-- <script src="index.js"></script> -->
        <script src="tb.js"></script>

        <script>
            
        </script>

</body>

</html>
