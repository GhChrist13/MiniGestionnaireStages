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
    <link rel="stylesheet" href="index.css">
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

            <!-- Barre de Recherche -->
            <div class="search">
                <input type="text" id="search" placeholder="Recherche"><span><i
                        class="fa-solid fa-magnifying-glass"></i></span>
            </div>

            <!-- Filtrage -->
            <div class="filtre">
                <?php
                $sql = "SELECT DISTINCT nom_entreprise FROM stage";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) { ?>
                    <div class="filtres"><?php echo "" . $row["nom_entreprise"] ?></div>
                    <?php
                }
                ?>
            </div>

            <!-- Block de stages -->

            <div class="stage" translate="no">

                <?php

                //Récupération des données de la base
                $sql = "SELECT * FROM stage";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) { ?>

                        <div class="stages">
                            <div class="images" style="background-image: url(<?php echo $row["adresse_image"] ?>);"></div>
                            <div class="desc">
                                <H2><?php echo $row["intitule_stage"]; ?></H2>
                                <h5><?php echo $row["adresse"] ?></h5>
                                <h6 translate="no">Stage</h6>
                                <span><i class="fa-solid fa-heart"></i></span>
                                <button>Voir l'offre</button>
                            </div>
                        </div>

                        <?php
                    }
                }
                ?>


                <!-- Formulaire d'ajout d'offre -->

                <div class="overlay">
                    <div class="form_contain">

                        <h2 translate="no">Ajouter un Stage</h2>

                        <form action="traitement.php" method="POST">
                            <input type="text" name="nom_entreprise" placeholder="Nom de l'entreprise" required>
                            <input type="text" name="intitule_stage" placeholder="Intitulé du stage" required>
                            <input type="text" name="adresse_entreprise" placeholder="Adresse de l'entreprise" required>
                            <input type="url" name="lien_image" placeholder="Lien de l'image">
                            <div class="form-buttons">
                                <button type="button" class="btn-annuler">Annuler</button>
                                <button type="submit" class="btn-envoyer">Envoyer</button>
                            </div>
                        </form>

                    </div>
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


    </div>

    <script src="index.js"></script>
    <script>



    </script>
</body>

</html>
