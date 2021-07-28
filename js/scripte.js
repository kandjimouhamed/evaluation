const pages = document.querySelectorAll(".page")
const header = document.querySelector("header")
const nbPages = pages.length
let pageActive = 1

window.onload = () =>{
   // on affiche la premiere du formulaire
   document.querySelector(".page").style.display = "initial"

   //afficher les numero de page dans l' entete
   //parcour les pages


//  on gere les button suivan
boutons = document.querySelectorAll(".suivant")
for (let bouton of boutons){
  bouton.addEventListener("click", pageSuivante)
}
//  on gere les button precedent
let boutonsRetour = document.querySelectorAll(".precedent")

for (let boutonR of boutonsRetour){
    boutonR.addEventListener("click", pageRetour)
}

}
function pageSuivante(){
   for (let page of pages) {
     page.style.display = "none"
   }
   this.parentElement.nextElementSibling.style.display = "initial"
    pageActive++
}
function pageRetour(){


   for (let page of pages) {
     page.style.display = "none"
   }
   this.parentElement.previousElementSibling.style.display = "initial"
    pageActive--
}