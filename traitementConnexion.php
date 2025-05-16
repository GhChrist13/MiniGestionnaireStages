<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Mini Gestionnaire de Stages</title>
    <link rel="stylesheet" href="connection.css">
    <!-- Font Awesome pour l’icône œil -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="connection.js" defer></script>
</head>

<body>

    <header>
        <div class="container">
            <h1>Connexion</h1>
            <nav>
                <a href="index.php">Accueil</a>
                <a href="inscription.php">S’inscrire</a>
            </nav>
        </div>
    </header>

    <main class="container">
        <section class="intro">
            <h2>Bienvenue sur la plateforme</h2>
            <p>Veuillez vous connecter pour accéder à votre tableau de bord étudiant.</p>
        </section>

        <section>
            <form id="loginForm" action="verifier_connexion.php" method="post" class="form-box">
                <div id="errorContainer"></div>

                <div class="form-group">
                    <label for="email">Adresse e-mail</label>
                    <input type="email" id="email" name="email" required placeholder="ex: etudiant@mail.com" />
                </div>

                <div class="form-group password-group">
                    <label for="password">Mot de passe</label>
                    <div class="password-wrapper">
                        <input type="password" id="password" name="password" required
                            placeholder="Votre mot de passe" />
                        <i id="togglePassword" class="fa-solid fa-eye-slash"></i>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn">Se connecter</button>
                </div>
            </form>
        </section>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2025 Mini Gestionnaire de Stages - Projet SLAM & CIEL</p>
        </div>
    </footer>

</body>

</html>
