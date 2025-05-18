// Déclaration des variables===========================================================

let centralBlock = document.querySelector('.central-block')
let stage = document.querySelector('.stage')
let side = document.querySelector('.side')
let barre = document.getElementById('barre')
let hiddenDesc = document.querySelectorAll('.hidden-desc')


// block latéral==================================================

barre.addEventListener('click', function () {
    
    side.classList.toggle('expand')
    if(side.classList.contains("expand")){stage.style = "grid-template-columns: 1fr 1fr;"}else{stage.style = "grid-template-columns: 1fr 1fr 1fr;"}
})
