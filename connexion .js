document.addEventListener("DOMContentLoaded", () => {
    const passwordInput = document.getElementById("password");
    const toggleIcon = document.getElementById("togglePassword");
    const loginForm = document.getElementById("loginForm");
    const errorContainer = document.getElementById("errorContainer");

    // Afficher / masquer le mot de passe
    toggleIcon.addEventListener("click", () => {
        const isVisible = passwordInput.type === "text";
        passwordInput.type = isVisible ? "password" : "text";
        toggleIcon.classList.toggle("fa-eye");
        toggleIcon.classList.toggle("fa-eye-slash");
    });

    // Validation basique du formulaire
    loginForm.addEventListener("submit", (e) => {
        errorContainer.innerText = "";
        const email = document.getElementById("email").value.trim();
        const password = passwordInput.value.trim();

        if (!email || !password) {
            e.preventDefault();
            errorContainer.innerText = "Veuillez remplir tous les champs.";
            errorContainer.style.color = "red";
        }
    });
});
