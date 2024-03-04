function myFunction(){
    var x = document.getElementById("MyTopnav");
    if (x.className === "topNav"){
        x.className = "navbarResponsive";
    } else{
        x.className = "topNav" ;
    }
}

//alerte lorsqu'un formulaire a été rempli et correctement ajouté à la bdd
const ajout = document.querySelector('.ajout');
ajout.addEventListener('click', showAlert);

function showAlert(){
    alert("Element ajouté")
}