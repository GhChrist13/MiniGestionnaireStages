// Déclaration des variables===========================================================

let centralBlock = document.querySelector('.central-block')
let stage = document.querySelector('.stage')
let side = document.querySelector('.side')
let barre = document.getElementById('barre')
let ajout_stage = document.getElementById('ajout_stage')
let form_contain = document.querySelector('.form_contain')
let hiddenDesc = document.querySelectorAll('.hidden-desc')
let btn_annuler = document.querySelector('.btn-annuler')
let overlay = document.querySelector('.overlay')
let tb = document.getElementById('table_bord')
let accueil = document.getElementById('accueil')
let side_items = document.querySelectorAll('.side-item')
let btn_ajout_stage = document.getElementById('btn_ajout_stage')
let btn_ajout_user = document.getElementById('btn_ajout_user')
let dark = document.querySelector('.dark_iu')


// block latéral==================================================

barre.addEventListener('click', function () {
    side.classList.toggle('expand');
    if (side.classList.contains("expand")) {
        stage.style = "grid-template-columns: 1fr 1fr;";
    } else {
        stage.style = "grid-template-columns: 1fr 1fr 1fr;";
    }

    side_items.forEach(item => {
        item.classList.toggle('exp');
    });
});


//ajout d'un stage

overlay.style.display = "none"
btn_annuler.addEventListener('click', function () { overlay.style.display = "none" })
btn_ajout_stage.addEventListener('click', function () { overlay.style = "display : block;" })

// Suppression de stage

document.querySelectorAll('.btn-supprimer-stage').forEach(btn => {
    btn.addEventListener('click', function () {
        const id = this.getAttribute('data-id');
        if (confirm("Voulez-vous vraiment supprimer ce stage ?")) {
            fetch('supprimer_stage.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'id=' + encodeURIComponent(id)
            })
                .then(response => response.text())
                .then(result => {
                    if (result === "OK") {
                        this.closest('tr').remove();
                    } else {
                        alert("Erreur lors de la suppression.");
                        console.error(result);
                    }
                })
                .catch(error => {
                    alert("Erreur réseau");
                    console.error(error);
                });
        }
    });
});


// Modification des stages


document.querySelectorAll('.btn-modifier-stage').forEach(btn => {
    btn.addEventListener('click', function () {
        const row = this.closest('tr');
        const id = row.querySelector('td:first-child').textContent.trim();
        const nomEntreprise = row.children[1].textContent.trim();
        const adresse = row.children[2].textContent.trim();
        const intitule = row.children[3].textContent.trim();
        const adresseImage = row.children[4].textContent.trim();

        overlay.style.display = "block";

        const form = overlay.querySelector('form');
        form.setAttribute('data-id', id);

        form.nom_entreprise.value = nomEntreprise;
        form.adresse_entreprise.value = adresse;
        form.intitule_stage.value = intitule;
        form.lien_image.value = adresseImage;

        form.querySelector('.btn-envoyer').textContent = "Modifier";
    });
});

const form = overlay.querySelector('form');
form.addEventListener('submit', function (e) {
    e.preventDefault();
    const id = form.getAttribute('data-id');

    if (id) {
        form.action = "modifier_stage.php";
        form.querySelector('input[name="id_stage"]').value = id;
    } else {
        form.action = "traitement.php";
    }
    form.submit();
});

btn_annuler.addEventListener('click', function () {
    overlay.style.display = "none";

    const form = overlay.querySelector('form');
    form.reset();
    form.removeAttribute('data-id');
    form.querySelector('input[name="id_stage"]').value = '';
    form.querySelector('.btn-envoyer').textContent = "Envoyer";
});



//aller au tableau de bord

tb.addEventListener('click', function () { window.location.href = "tb-entreprise.php" })

// retour à la page d'accueil

accueil.addEventListener('click', function () { window.location.href = "index-entreprise.php" })

// // Profil


overlay_profil.style.display = "none";

btn_profil.addEventListener('click', function () {
    let user_mail = prompt("Confirmer votre adresse E-mail");
    let user_password = prompt("Confirmer votre mot de passe");

    const params = new URLSearchParams();
    params.append("email", user_mail);
    params.append("password", user_password);

    fetch("traitement_profil.php", {
        method: "POST",
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: params.toString()
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                profil.querySelector(".info-nom").textContent = `${data.prenom} ${data.nom}`;
                profil.querySelector(".info-email").textContent = data.email;
                profil.querySelector(".info-role").textContent = data.roleU;
                overlay_profil.style.display = "flex";
            } else {
                alert("Identifiants incorrects ou utilisateur introuvable.");
            }
        })
        .catch(error => {
            console.error('Erreur fetch:', error);
        });
    document.getElementById('btn-fermer-profil').addEventListener('click', function () { overlay_profil.style.display = "none" })
});