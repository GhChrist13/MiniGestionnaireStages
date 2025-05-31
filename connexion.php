<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Connexion - Espace Utilisateur</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-image: url('image.png');
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .dark {
            width: 100%;
            height: 100vh;
            background-color: rgba(0, 0, 0, 0.8);
        }

        .login-card {
            background: local;
            margin: 10% auto;
            padding: 40px 30px;
            border-radius: 15px;
            box-shadow: rgba(0, 0, 255, 0.3) 0px 1px 2px 0px,
                rgba(0, 0, 255, 0.15) 0px 2px 6px 2px;
            width: 100%;
            max-width: 400px;
            animation: fadeIn 0.6s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-card h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #c9c9c9;
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
            color: #c9c9c9;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            padding-right: 45px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus {
            outline: none;
            border-color: #007BFF;
        }

        .toggle-password {
            position: absolute;
            top: 40px;
            right: 12px;
            background: none;
            border: none;
            font-size: 20px;
            cursor: pointer;
            color: #555;
        }

        .login-btn {
            width: 100%;
            padding: 12px;
            background-color: #007BFF;
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .login-btn:hover {
            background-color: #0056b3;
        }

        .footer-text {
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
            color: #c1c1c1;
        }

        .footer-text a {
            color: #007BFF;
            text-decoration: none;
        }

        .footer-text a:hover {
            text-decoration: underline;
        }

        @media (max-width: 480px) {
            .login-card {
                padding: 30px 20px;
            }
        }
    </style>
</head>

<body>

    <div class="dark">

        <div class="login-card">
            <h2>Connexion</h2>
            <form action="traitement_connexion.php" method="POST">
                <div class="form-group">
                    <label for="email">Adresse e-mail</label>
                    <input type="email" id="email" name="email" placeholder="exemple@domaine.com" required />
                </div>

                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" placeholder="Votre mot de passe" required />
                    <button type="button" class="toggle-password" onclick="togglePasswordVisibility()"
                        title="Afficher/Masquer">
                        👁️
                    </button>
                </div>

                <button type="submit" class="login-btn">Se connecter</button>
            </form>
            <div class="footer-text">
                <p>Vous n'avez pas de compte ? <a href="inscription.php">Créer un compte</a></p>
            </div>
        </div>

    </div>

    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById("password");
            const toggleBtn = document.querySelector(".toggle-password");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                toggleBtn.textContent = "🙈";
            } else {
                passwordInput.type = "password";
                toggleBtn.textContent = "👁️";
            }
        }

        fetch
    </script>

</body>

</html>