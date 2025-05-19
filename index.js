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


// block latéral==================================================

barre.addEventListener('click', function () {
    side.classList.toggle('expand')
    if(side.classList.contains("expand")){stage.style = "grid-template-columns: 1fr 1fr;"}else{stage.style = "grid-template-columns: 1fr 1fr 1fr;"}
})

//ajout d'un stage

overlay.style.display = "none"
ajout_stage.addEventListener('click', function(){overlay.style = "display : block;"})
btn_annuler.addEventListener('click', function(){overlay.style.display = "none"})
