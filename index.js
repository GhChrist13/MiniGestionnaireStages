// Déclaration des variables===========================================================

let centralBlock = document.querySelector('.central-block')
let stage = document.querySelector('.stage')
let side = document.querySelector('.side')
let barre = document.getElementById('barre')
let form_contain = document.querySelector('.form_contain')
let hiddenDesc = document.querySelectorAll('.hidden-desc')
let btn_annuler = document.querySelector('.btn-annuler')
let overlay = document.querySelector('.overlay')
let tb = document.getElementById('table_bord')
let accueil = document.getElementById('accueil')
let side_item = document.querySelectorAll('.side-item')
let filtres = document.querySelectorAll('.filtres')
let voir_offres = document.querySelectorAll('.voir_offre')
let overlay_offre = document.querySelector('.overlay_offre')
let info_offre = document.querySelector('.info_offre')
let search = document.getElementById('search')
let coeurs = document.querySelectorAll('.coeur')
let like = document.getElementById('like')


// block latéral==================================================

barre.addEventListener('click', function () {
    side.classList.toggle('expand')
    if (side.classList.contains("expand")) { stage.style = "grid-template-columns: 1fr 1fr;" } else { stage.style = "grid-template-columns: 1fr 1fr 1fr;" }
    side_item.forEach(side_item => {
        side_item.classList.toggle('exp')
    })
})

//ajout d'un stage============================================

overlay.style.display = "none"
btn_annuler.addEventListener('click', function () { overlay.style.display = "none" })
overlay.addEventListener('click', function (e) {
    if (e.target === overlay) {
        overlay.style.display = "none";
    }
});


//tableau de bord

tb.addEventListener('click', function () { window.location.href = "tb.php" })

// page accueil

accueil.addEventListener('click', function () {
    if(confirm('Vous allez être déconnecté !')){
        window.location.href = "pageAccueil.html"
    }
})


// filtrage===============================================

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

// recherche de stage====================================

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


// Consultation des offressss====================================================

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