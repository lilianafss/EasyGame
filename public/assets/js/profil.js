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

    var nom = document.getElementById("nomActuel");
    var prenom = document.getElementById("prenomActuel");
    var pseudo = document.getElementById("pseudoActuel");
    var password = document.getElementById("motPasseActuel");
    var nouveauPassword = document.getElementById("editPasseActuel");

    var btnValider = document.getElementById("valider");
    var btnEditer = document.getElementById("editer");

    if (inputNom.style.display === "none" && inputPrenom.style.display === "none" & inputPseudo.style.display === "none") {
        inputNom.style.display = "block";
        inputPrenom.style.display = "block";
        inputPseudo.style.display = "block";
        nouveauPassword.style.display = "block";
        btnValider.style.display = "block";

        nom.style.display = "none";
        prenom.style.display = "none";
        pseudo.style.display = "none";
        password.style.display = "none";
        btnEditer.style.display = "none";

        return false;
    } else {
        inputNom.style.display = "none";
        inputPrenom.style.display = "none";
        inputPseudo.style.display = "none";
        nouveauPassword.style.display = "none";
        btnValider.style.display = "none";

        nom.style.display = "block";
        prenom.style.display = "block";
        pseudo.style.display = "block";
        password.style.display = "block";
        btnEditer.style.display = "block";

    }

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