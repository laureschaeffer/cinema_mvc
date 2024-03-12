
//navbar responsive
function myFunction(){
    var x = document.getElementById("MyTopnav");
    if (x.className === "topNav"){
        x.className = "navbarResponsive";
    } else{
        x.className = "topNav" ;
    }
}

//-------------les deux fonctions pour darkmode/lightmode
//change le background en clair (le darkmode est par défaut)

function toggleMode() {
    const wrapper = document.getElementById("wrapper");
    wrapper.classList.toggle("light-mode");
    setLightMode();
}

//change l'icone en lune ou soleil et les elements en blanc en noir
function setLightMode() {
    const iconElement = document.getElementById("modeIcon");
    const wrapper = document.getElementById("wrapper");
    const isLightMode = wrapper.classList.contains("light-mode");

    //icones font-awesome
    iconElement.className = isLightMode ? "ri-moon-line" : "ri-sun-line";


    //je cherche les elements dont la propriété correspond a --main-txt-color(blanc), definit dans le root 
    const currentColor = getComputedStyle(document.documentElement).getPropertyValue('--main-txt-color');
    //si la couleur est blanche, alors change la en noir, et inversement
    const newColor = currentColor === 'white' ? 'black' : 'white';
    //ajoute cette propriété
    document.documentElement.style.setProperty('--main-txt-color', newColor);


}

