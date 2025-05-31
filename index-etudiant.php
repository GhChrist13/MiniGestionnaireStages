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
    <link rel="stylesheet" href="index-etudiant.css">
    <title>Gestionnaire de stages</title>
</head>

<body>

    <!-- Entête de la page============================================-->
    <div class="title" translate="no">
        <div class="logo"></div>
        <div class="text"><span style="color: rgb(60, 70, 278)">S</span>tage<span
                style="color: rgb(60, 70, 278)">C</span>onnect</div>
    </div>

    <!-- Corps de page============================================== -->

    <div class="contain">

        <!-- Block central========================= -->
        <div class="central-block">

            <!-- Barre de Recherche -->
            <div class="search">
                <input type="text" id="search" placeholder="Recherche"><span><i
                        class="fa-solid fa-magnifying-glass"></i></span>
            </div>

            <!-- Filtrage -->
            <div class="filtre" translate="no">
                <div class="filtres">TOUS</div>
                <?php
                $sql = "SELECT DISTINCT nom_entreprise FROM stage";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) { ?>
                    <div class="filtres"><?php echo "" . $row["nom_entreprise"] ?></div>
                    <?php
                }
                ?>
            </div>

            <!-- Block de stages================================================= -->

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
                                <h5 style="display: none"><?php echo $row["nom_entreprise"] ?></h5>
                                <h5 style="display: none"><?php echo $row["desc_stage"] ?></h5>
                                <h6 translate="no">Stage</h6>
                                <span class="coeur"><i class="fa-solid fa-heart"></i></span>
                                <button class="voir_offre">Voir l'offre</button>
                            </div>
                        </div>

                        <?php
                    }
                }
                ?>
            </div>
        </div>

        <!-- Consultation ds offres======================================= -->

        <div class="overlay_offre">
            <div class="info_offre">
                <h1><!-- intitule stage --></h1>
                --- >
                <h2><!-- nom entreprise --></h2>
                <h3><!-- adresse --></h3>
                <span><!-- desc --></span>
                <div class="btn-offre">
                    <button type="button" class="btn-fermer">Fermer</button>
                    <button type="button" class="btn-postuler">Postuler</button>
                </div>
            </div>
        </div>


        <!-- profil=============================================== -->


        <div class="overlay-profil">
            <div class="profil">
                <div class="info">
                    <div class="pp"><i class="fa-solid fa-user"></i></div>
                    <p class="info-nom"></p>
                    <p class="info-email"></p>
                    <p class="info-role"></p>
                </div>
                <div class="actions">
                    <button id="btn-modifier">Modifier</button>
                    <button id="btn-supprimer">Supprimer le compte</button>
                    <button id="btn-fermer-profil">Fremer</button>
                </div>

                <div class="fav"></div>
            </div>
        </div>


        <!-- Barre latérale======================== -->
        <div class="side">
            <div class="side-item" id="accueil">
                <i class="fa-solid fa-house"></i><span>Accueil</span>
            </div>
            <div class="side-item" id="like">
                <i class="fa-solid fa-heart"></i><span>Favoris</span>
            </div>
            <div class="side-item" id="btn_profil">
                <i class="fa-solid fa-user"></i><span>Profil</span>
            </div>
            <div class="side-item" id="night-icon">
                <i class="fa-solid fa-moon"></i><span>Nuit</span>
            </div>

        </div>


    </div>


    <!-- footer -->

    <footer>

        <div class="foot">

            <div class="application">
                <p class="application-p">Telecharger Application</p>
                <img class="application-img" src="logo.png" alt="">
            </div>

            <div class="suivre">
                <p class="suivre-p">Suivi nous sur nos réseaux</p>
                <ul class="suivre-nav">
                    <li class="nav-links-footer"><i class="fa-brands fa-facebook"></i></li>
                    <li class="nav-links-footer"><i class="fa-brands fa-square-instagram"></i></li>
                    <li class="nav-links-footer"><i class="fa-brands fa-youtube"></i></li>
                    <li class="nav-links-footer"><i class="fa-brands fa-linkedin"></i></li>
                    <li class="nav-links-footer"><i class="fa-brands fa-tiktok"></i></li>
                </ul>

            </div>
        </div>

        <div class="footer-bottom">
            &copy; 2025 StageConnect. Tous droits réservés.
        </div>

    </footer>

    <script src="index-etudiant.js"></script>
    <script>

    </script>
</body>

</html>