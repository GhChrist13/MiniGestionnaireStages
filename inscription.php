<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Inscription - Mini Gestionnaire de Stages</title>
    <link rel="stylesheet" href="inscription.css" />
    <style>
        .toggle-password {
            position: absolute;
            top: 38px;
            right: 12px;
            background: none;
            border: none;
            font-size: 20px;
            cursor: pointer;
            color: #555;
        }

        .form-group {
            position: relative;
        }
    </style>
</head>

<body>

    <div class="dark">
        <div class="container">
            <h1>Créer un compte</h1>

            <form action="traitement_inscription.php" method="POST" novalidate>
                <div class="form-group">
                    <label for="lastname">Nom</label>
                    <input type="text" id="lastname" name="lastname" placeholder="Votre nom" required />
                </div>

                <div class="form-group">
                    <label for="firstname">Prénom</label>
                    <input type="text" id="firstname" name="firstname" placeholder="Votre prénom" required />
                </div>

                <div class="form-group">
                    <label for="email">Adresse e-mail</label>
                    <input type="email" id="email" name="email" placeholder="exemple@mail.com" required />
                </div>

                <div class="form-group">
                    <label for="role">Rôle</label>
                    <select name="role" id="role">
                        <option value="ETUDIANT">Étudiant</option>
                        <option value="ENTREPRISE">Entreprise</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" placeholder="Votre mot de passe" required
                        minlength="6" />
                    <button type="button" class="toggle-password"
                        onclick="toggleVisibility('password', this)">👁️</button>
                </div>


                <div class="form-group">
                    <label for="passwordConfirm">Confirmer le mot de passe</label>
                    <input type="password" id="passwordConfirm" name="passwordConfirm"
                        placeholder="Confirmez votre mot de passe" required minlength="6" />
                    <button type="button" class="toggle-password"
                        onclick="toggleVisibility('passwordConfirm', this)">👁️</button>
                </div>

                <button type="submit">S’inscrire</button>
            </form>

            <div class="form-footer">
                <p style="color: #c9c9c9;">Vous avez déjà un compte ? <a href="connexion.php">Se connecter</a></p>
            </div>
        </div>
    </div>

    <script>
        function toggleVisibility(id, btn) {
            const input = document.getElementById(id);
            if (input.type === "password") {
                input.type = "text";
                btn.textContent = "🙈";
            } else {
                input.type = "password";
                btn.textContent = "👁️";
            }
        }
    </script>

</body>

</html>