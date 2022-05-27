function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();

function editProfil() {
    var inputNom = document.getElementById("editNom");
    var inputPrenom = document.getElementById("editPrenom");
    var inputPseudo = document.getElementById("editPseudo");

    var nom = document.getElementById("nom");
    var prenom = document.getElementById("prenom");
    var pseudo = document.getElementById("pseudo");
    var email = document.getElementById("email");
    var nouveauPassword = document.getElementById("nouveauPassword");

    var btnValider = document.getElementById("valider");
    var btnEditer = document.getElementById("editer");

    if (inputNom.style.display === "none" && inputPrenom.style.display === "none" && inputPseudo.style.display === "none") {
        inputNom.style.display = "block";
        inputPrenom.style.display = "block";
        inputPseudo.style.display = "block";
        nouveauPassword.style.display = "block";
        btnValider.style.display = "block";

        nom.style.display = "none";
        prenom.style.display = "none";
        pseudo.style.display = "none";
        email.style.display = "none";
        btnEditer.style.display = "none";

        return false;
    }
    // var profil = document.getElementById("profil");
    // var modifierProfil = document.getElementById("modifier");

    // if (inputNom.style.display === "none") {
    //     inputNom.style.display === "block"

    //     return false;
    // }
}

function Redirection(id) {

    let stringUrl = "http://easygame.ch/jeux?idJeux=" + id;

    window.location.replace(stringUrl);
}
$('.round').click(function(e) {
    e.preventDefault();
    e.stopPropagation();
    $('.arrow').toggleClass('bounceAlpha');
});