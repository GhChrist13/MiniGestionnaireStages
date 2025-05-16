<?php
session_start();

// Connexion à la base de données (à adapter avec tes infos)
$host = 'localhost';
$dbname = 'gestion_stages';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération et nettoyage des données
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'] ?? '';

    if (!$email) {
        $error = "Veuillez saisir une adresse e-mail valide.";
    } elseif (empty($password)) {
        $error = "Veuillez saisir votre mot de passe.";
    } else {
        // Recherche de l'utilisateur par email
        $stmt = $pdo->prepare("SELECT id, nom, email, password_hash FROM utilisateurs WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password_hash'])) {
            // Identifiants corrects, création session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['nom'];

            // Redirection vers tableau de bord
            header('Location: index.php');
            exit;
        } else {
            $error = "Adresse e-mail ou mot de passe incorrect.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Connexion - Mini Gestionnaire de Stages</title>
    <link rel="stylesheet" href="connection.css" />
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
            <?php if ($error): ?>
                <div class="error-message" style="color: red; margin-bottom: 1em;">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <form action="connexion.php" method="post" class="form-box">
                <div class="form-group">
                    <label for="email">Adresse e-mail</label>
                    <input type="email" id="email" name="email" required placeholder="ex: etudiant@mail.com"
                        value="<?= isset($email) ? htmlspecialchars($email) : '' ?>" />
                </div>

                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" required placeholder="Votre mot de passe" />
                </div>

                <div class="form-group checkbox-container">
                    <input type="checkbox" id="showPassword" onclick="togglePasswordVisibility()" />
                    <label for="showPassword">Afficher le mot de passe</label>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn">Se connecter</button>
                </div>
            </form>
        </section>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2025 Mini Gestionnaire de Stages - Projet SLAM &amp; CIEL</p>
        </div>
    </footer>

    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById("password");
            passwordInput.type = passwordInput.type === "password" ? "text" : "password";
        }
    </script>

</body>

</html>
