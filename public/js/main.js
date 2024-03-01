function myFunction(){
    var x = document.getElementById("MyTopnav");
    if (x.className === "topNav"){
        x.className = "navbarResponsive";
    } else{
        x.className = "topNav" ;
    }
}

const ajout = document.querySelector('.ajout');
ajout.addEventListener('click', showAlert);

function showAlert(){
    alert("Element ajouté")
}