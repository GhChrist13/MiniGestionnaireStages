// Attente que le DOM soit chargé
document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("inscriptionForm");
    const passwordInput = document.getElementById("password");
    const confirmPasswordInput = document.getElementById("confirmPassword");
    const toggleIcon = document.getElementById("togglePassword");
    const errorContainer = document.getElementById("errorContainer");

    // ✅ Affichage / Masquage du mot de passe
    toggleIcon.addEventListener("click", () => {
        const isPasswordVisible = passwordInput.type === "text";
        passwordInput.type = isPasswordVisible ? "password" : "text";
        confirmPasswordInput.type = isPasswordVisible ? "password" : "text";
        toggleIcon.classList.toggle("fa-eye");
        toggleIcon.classList.toggle("fa-eye-slash");
    });

    // ✅ Validation du formulaire
    form.addEventListener("submit", function (e) {
        errorContainer.innerHTML = ""; // Réinitialise les erreurs

        const email = form.email.value.trim();
        const password = passwordInput.value.trim();
        const confirmPassword = confirmPasswordInput.value.trim();
        const nom = form.nom.value.trim();
        const prenom = form.prenom.value.trim();

        let errors = [];

        if (!email.includes("@")) {
            errors.push("L'adresse email est invalide.");
        }

        if (nom === "" || prenom === "") {
            errors.push("Le nom et le prénom sont obligatoires.");
        }

        if (password.length < 6) {
            errors.push("Le mot de passe doit contenir au moins 6 caractères.");
        }

        if (password !== confirmPassword) {
            errors.push("Les mots de passe ne correspondent pas.");
        }

        if (errors.length > 0) {
            e.preventDefault();
            displayErrors(errors);
        }
    });

    // ✅ Affiche les erreurs dans le conteneur
    function displayErrors(errors) {
        const ul = document.createElement("ul");
        ul.classList.add("error-list");

        errors.forEach(error => {
            const li = document.createElement("li");
            li.textContent = error;
            ul.appendChild(li);
        });

        errorContainer.appendChild(ul);
    }
});
