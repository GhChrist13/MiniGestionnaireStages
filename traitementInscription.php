<?php
session_start();

// Connexion à la base de données (à adapter avec tes paramètres)
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
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération et nettoyage des données
    $nom = trim($_POST['nom'] ?? '');
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'] ?? '';
    $password_confirm = $_POST['password_confirm'] ?? '';

    // Validation des champs
    if (empty($nom)) {
        $error = "Veuillez saisir votre nom.";
    } elseif (!$email) {
        $error = "Veuillez saisir une adresse e-mail valide.";
    } elseif (empty($password) || empty($password_confirm)) {
        $error = "Veuillez saisir et confirmer votre mot de passe.";
    } elseif ($password !== $password_confirm) {
        $error = "Les mots de passe ne correspondent pas.";
    } else {
        // Vérification si l'email existe déjà
        $stmt = $pdo->prepare("SELECT id FROM utilisateurs WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        if ($stmt->fetch()) {
            $error = "Cette adresse e-mail est déjà utilisée.";
        } else {
            // Hashage du mot de passe
            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            // Insertion dans la base
            $stmt = $pdo->prepare("INSERT INTO utilisateurs (nom, email, password_hash) VALUES (:nom, :email, :password_hash)");
            $stmt->execute([
                'nom' => $nom,
                'email' => $email,
                'password_hash' => $password_hash,
            ]);

            $success = "Votre compte a été créé avec succès. Vous pouvez maintenant vous connecter.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Inscription - Mini Gestionnaire de Stages</title>
    <link rel="stylesheet" href="inscription.css" />
</head>

<body>

    <header>
        <div class="container">
            <h1>Inscription</h1>
            <nav>
                <a href="index.php">Accueil</a>
                <a href="connexion.php">Se connecter</a>
            </nav>
        </div>
    </header>

    <main class="container">
        <section class="intro">
            <h2>Créer un nouveau compte</h2>
            <p>Remplissez le formulaire ci-dessous pour vous inscrire.</p>
        </section>

        <section>
            <?php if ($error): ?>
                <div class="error-message" style="color: red; margin-bottom: 1em;">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php elseif ($success): ?>
                <div class="success-message" style="color: green; margin-bottom: 1em;">
                    <?= htmlspecialchars($success) ?>
                </div>
            <?php endif; ?>

            <form action="inscription.php" method="post" class="form-box">
                <div class="form-group">
                    <label for="nom">Nom complet</label>
                    <input type="text" id="nom" name="nom" required placeholder="Votre nom complet"
                        value="<?= isset($nom) ? htmlspecialchars($nom) : '' ?>" />
                </div>

                <div class="form-group">
                    <label for="email">Adresse e-mail</label>
                    <input type="email" id="email" name="email" required placeholder="ex: etudiant@mail.com"
                        value="<?= isset($email) ? htmlspecialchars($email) : '' ?>" />
                </div>

                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" required placeholder="Votre mot de passe" />
                </div>

                <div class="form-group">
                    <label for="password_confirm">Confirmer le mot de passe</label>
                    <input type="password" id="password_confirm" name="password_confirm" required
                        placeholder="Confirmez votre mot de passe" />
                </div>

                <div class="form-group">
                    <button type="submit" class="btn">S’inscrire</button>
                </div>
            </form>
        </section>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2025 Mini Gestionnaire de Stages - Projet SLAM &amp; CIEL</p>
        </div>
    </footer>

</body>

</html>
