<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Mini Gestionnaire de Stages</title>
    <link rel="stylesheet" href="inscription.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="inscription.js" defer></script>
</head>

<body>

    <header>
        <div class="container">
            <h1>Inscription</h1>
            <nav>
                <a href="index.php">Accueil</a>
                <a href="connection.php">Connexion</a>
            </nav>
        </div>
    </header>

    <main class="container">
        <section class="intro">
            <h2>Créer un compte étudiant</h2>
            <p>Remplissez le formulaire ci-dessous pour vous inscrire sur la plateforme.</p>
        </section>

        <!-- Conteneur d'erreurs -->
        <div id="errorContainer" class="error-container"></div>

        <section>
            <form id="inscriptionForm" action="traitement_inscription.php" method="POST" class="form-box">

                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text" id="nom" name="nom" required placeholder="Votre nom">
                </div>

                <div class="form-group">
                    <label for="prenom">Prénom</label>
                    <input type="text" id="prenom" name="prenom" required placeholder="Votre prénom">
                </div>

                <div class="form-group">
                    <label for="email">Adresse e-mail</label>
                    <input type="email" id="email" name="email" required placeholder="ex: etudiant@mail.com">
                </div>

                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <div class="password-wrapper">
                        <input type="password" id="password" name="password" required placeholder="Votre mot de passe">
                        <i id="togglePassword" class="fa-solid fa-eye-slash toggle-password"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label for="confirmPassword">Confirmer le mot de passe</label>
                    <input type="password" id="confirmPassword" name="confirmPassword" required
                        placeholder="Répétez le mot de passe">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn">S'inscrire</button>
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
