<?php
session_start();

// Exemple simple de contrôle d'accès
if (!isset($_SESSION['user_id'])) {
    // Utilisateur non connecté, redirection vers login
    header('Location: connexion.php');
    exit;
}

// Ici, on récupère les infos utilisateur (ex: depuis base de données)
// Pour cet exemple, on simule avec des données statiques
$userName = $_SESSION['user_name'] ?? 'Étudiant';

// Exemple de données de stages (à remplacer par une requête SQL)
$stages = [
    [
        'titre' => 'Développement Web',
        'entreprise' => 'TechCorp',
        'date_debut' => '2025-06-01',
        'date_fin' => '2025-08-31',
        'etat' => 'Validé',
    ],
    [
        'titre' => 'Analyse de données',
        'entreprise' => 'DataSolutions',
        'date_debut' => '2025-09-15',
        'date_fin' => '2025-12-15',
        'etat' => 'En cours',
    ],
];
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Tableau de bord - Mini Gestionnaire de Stages</title>
    <link rel="stylesheet" href="style.css" />
    <!-- Tu peux créer style.css basé sur ta connection.css en adaptant les styles -->
</head>

<body>

    <header>
        <div class="container">
            <h1>Bienvenue, <?= htmlspecialchars($userName) ?> !</h1>
            <nav>
                <a href="ajouter_stage.php">Ajouter un stage</a>
                <a href="rechercher_offres.php">Rechercher des offres</a>
                <a href="profil.php">Mon profil</a>
                <a href="logout.php" style="color: red;">Se déconnecter</a>
            </nav>
        </div>
    </header>

    <main class="container">
        <section>
            <h2>Mes stages</h2>

            <?php if (count($stages) === 0): ?>
                <p>Vous n'avez aucun stage enregistré pour le moment.</p>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>Titre</th>
                            <th>Entreprise</th>
                            <th>Date de début</th>
                            <th>Date de fin</th>
                            <th>État</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($stages as $stage): ?>
                            <tr>
                                <td><?= htmlspecialchars($stage['titre']) ?></td>
                                <td><?= htmlspecialchars($stage['entreprise']) ?></td>
                                <td><?= htmlspecialchars($stage['date_debut']) ?></td>
                                <td><?= htmlspecialchars($stage['date_fin']) ?></td>
                                <td><?= htmlspecialchars($stage['etat']) ?></td>
                                <td>
                                    <a href="modifier_stage.php?id=<?= urlencode($stage['titre']) ?>">Modifier</a> |
                                    <a href="supprimer_stage.php?id=<?= urlencode($stage['titre']) ?>"
                                        onclick="return confirm('Voulez-vous vraiment supprimer ce stage ?');">Supprimer</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </section>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2025 Mini Gestionnaire de Stages - Projet SLAM &amp; CIEL</p>
        </div>
    </footer>

</body>

</html>
