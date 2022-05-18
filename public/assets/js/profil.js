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
    var inputEmail = document.getElementById("editEmail");

    var nom = document.getElementById("nom");
    var prenom = document.getElementById("prenom");
    var pseudo = document.getElementById("pseudo");
    var email = document.getElementById("email");

    var btn = document.getElementsByName("valider");

    if (inputNom.style.display === "none" && inputPrenom.style.display === "none" && inputPseudo.style.display === "none" && inputEmail.style.display === "none") {
        inputNom.style.display = "block";
        inputPrenom.style.display = "block";
        inputPseudo.style.display = "block";
        inputEmail.style.display = "block";
        btn.style.display = "block";

        nom.style.display = "none";
        prenom.style.display = "none";
        pseudo.style.display = "none";
        email.style.display = "none";
    }
}

function valider() {
    var inputNom = document.getElementById("editNom");
    var inputPrenom = document.getElementById("editPrenom");
    var inputPseudo = document.getElementById("editPseudo");
    var inputEmail = document.getElementById("editEmail");

    var nom = document.getElementById("nom");
    var prenom = document.getElementById("prenom");
    var pseudo = document.getElementById("pseudo");
    var email = document.getElementById("email");


    if (inputNom.style.display === "block" && inputPrenom.style.display === "block" && inputPseudo.style.display === "block" && inputEmail.style.display === "block") {
        inputNom.style.display = "none";
        inputPrenom.style.display = "none";
        inputPseudo.style.display = "none";
        inputEmail.style.display = "none";


        nom.style.display = "block";
        prenom.style.display = "block";
        pseudo.style.display = "block";
        email.style.display = "block";
    }
}