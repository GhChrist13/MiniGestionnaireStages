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
let side_item = document.querySelectorAll('.side-item')
let filtres = document.querySelectorAll('.filtres')


// block latéral==================================================

barre.addEventListener('click', function () {
    side.classList.toggle('expand')
    if (side.classList.contains("expand")) { stage.style = "grid-template-columns: 1fr 1fr;" } else { stage.style = "grid-template-columns: 1fr 1fr 1fr;" }
    side_item.forEach(side_item => {
        side_item.classList.toggle('exp')
    })
})

//ajout d'un stage

overlay.style.display = "none"
ajout_stage.addEventListener('click', function () { overlay.style = "display : block;" })
btn_annuler.addEventListener('click', function () { overlay.style.display = "none" })
overlay.addEventListener('click', function (e) {
    if (e.target === overlay) {
        overlay.style.display = "none";
    }
});


//tableau de bord

tb.addEventListener('click', function () { window.location.href = "tb.php" })

// page accueil

accueil.addEventListener('click', function () { window.location.href = "index.php" })


// filtrage

filtres.forEach(filtre => {
    filtre.addEventListener('click', function (e) {

                filtres.forEach(f => f.classList.remove('active'));
                filtre.classList.add('active');

                // affichage
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
