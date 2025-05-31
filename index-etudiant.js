// Déclaration des variables===========================================================

let centralBlock = document.querySelector('.central-block')
let stage = document.querySelector('.stage')
let side = document.querySelector('.side')
let barre = document.getElementById('barre')
let ajout_stage = document.getElementById('ajout_stage')
let form_contain = document.querySelector('.form_contain')
let hiddenDesc = document.querySelectorAll('.hidden-desc')
let btn_annuler = document.querySelector('.btn-annuler')
let tb = document.getElementById('table_bord')
let accueil = document.getElementById('accueil')
let side_item = document.querySelectorAll('.side-item')
let filtres = document.querySelectorAll('.filtres')
let voir_offres = document.querySelectorAll('.voir_offre')
let overlay_offre = document.querySelector('.overlay_offre')
let info_offre = document.querySelector('.info_offre')
let search = document.getElementById('search')
let profil = document.querySelector('.profil')
let btn_profil = document.querySelector('#btn_profil')
let overlay_profil = document.querySelector('.overlay-profil')
let coeurs = document.querySelectorAll('.coeur')
let like = document.getElementById('like')


// block latéral==================================================


side_item.forEach(side_item => {
    side_item.classList.toggle('exp')
})

// retour page accueil

accueil.addEventListener('click', function () {
    if (confirm('Vous allez être déconnecté ! ')) {
        window.location.href = "http://localhost/gestionnaireStages/pageAccueil.html"
    }
})

// filtrage stage

filtres.forEach(filtre => {
    filtre.addEventListener('click', function (e) {
        filtres.forEach(f => f.classList.remove('active'));
        filtre.classList.add('active');

        const nomFiltre = e.target.innerText;
        fetch("filtrer_stages.php", {
            method: "POST",
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'nomFiltre=' + encodeURIComponent(nomFiltre)
        })
            .then(response => response.text())
            .then(data => {
                stage.innerHTML = data;
            })
            .catch(error => {
                console.error('Erreur fetch:', error);
            });
    })
})


// recherche

search.parentNode.children[1].addEventListener('click', function () {
    let key_word = search.value
    fetch("recherche_stage.php", {
        method: "POST",
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'key_word=' + encodeURIComponent(key_word)
    })
        .then(response => response.text())
        .then(data => {
            stage.innerHTML = data;
        })
        .catch(error => {
            console.error('Erreur fetch:', error);
        });
})

// mode nuit

document.getElementById('night-icon').addEventListener('click', function () {
    document.body.classList.toggle('night');
    document.getElementById('search').classList.toggle('night')
    voir_offres.forEach(voir_offre => { voir_offre.classList.toggle("night") })
    info_offre.classList.toggle('night')
    document.querySelector('.btn-fermer').classList.toggle('night')
    document.querySelector('.btn-postuler').classList.toggle('night')
    if (document.body.classList.contains('night')) { this.style.color = "blue" } else { this.style.color = "black" }
})

// Consultation des offressss

overlay_offre.style.display = "none";
voir_offres.forEach(voir_offre => {
    voir_offre.addEventListener('click', function () {
        const row = this.closest('.desc');
        const intitule_stage = row.children[0].textContent.trim();
        const adresse = row.children[1].textContent.trim();
        const desc_stage = row.children[3].textContent.trim();
        const nom_entreprise = row.children[2].textContent.trim();

        overlay_offre.style.display = "block"
        info_offre.children[1].innerHTML = nom_entreprise
        info_offre.children[0].innerHTML = intitule_stage
        info_offre.children[2].innerHTML = adresse
        info_offre.children[3].innerHTML = desc_stage
    })
})

document.querySelector('.btn-fermer').addEventListener('click', function () { overlay_offre.style.display = "none" })


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


// coeur rouge

coeurs.forEach(coeur => {
    coeur.addEventListener('click', function () {
        this.querySelector('i').classList.toggle("rouge")
    })
})

like.addEventListener('click', function () {
    this.classList.toggle('rouge')
    document.querySelectorAll('.desc').forEach(desc => {
        // alert(desc.lastElementChild.previousElementSibling.className)
        if (desc.lastElementChild.previousElementSibling.querySelector('i').classList.contains('rouge')) {
            desc.parentNode.style.display = "block"
        } else {
            desc.parentNode.style.display = "none"
        }
    })
})