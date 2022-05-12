function cliquerGenres(genre) {

    let nbGenre = document.getElementById("nbGenre").value;
    let tableau = "";
    let genreModel = genre;

    for (let i = 1; i <= nbGenre; i++) {
        tableau += '<select id="nbGenre' + i + ' name="nbGenre' + i + '">';

        for (let i = 0; i < genreModel.length; i++) {
            tableau += '<option value="' + genreModel[i]['idGenre'] + '">' + genreModel[i]['genre'] + '</option>';
        }
        tableau += '</select><br>';
    }
    document.getElementById("selectedGenres").innerHTML = tableau;
    sessionStorage.setItem("genres",tableau);
}

function cliquerPlateformes(plateforme){

    let nbPlateforme = document.getElementById("nbPlatform").value;
    let tableau = "";
    let plateformeModel = plateforme;

    for (let i = 1; i <= nbPlateforme; i++) {
        tableau += '<select id="nbPlatform' + i + ' name="nbPlatform' + i + '">';

        for (let i = 0; i < plateformeModel.length; i++) {
            tableau += '<option value="' + plateformeModel[i]['idPlateforme'] + '">' + plateformeModel[i]['plateforme'] + '</option>';
        }
        tableau += '</select><br>';
    }
    document.getElementById("selectedPlateformes").innerHTML = tableau;
    sessionStorage.setItem("plateformes",tableau);
}

function stickyForm(){    
    let isValid = true; 
    let nomJeu = document.getElementById("nomJeu").value 
    let prix = document.getElementById("prix").value
    let descrif = document.getElementById("descrifJeu").value
    let genres = document.getElementById("selectedGenres").value
    let plateforme = document.getElementById("selectedPlateformes").value
    let pegi = document.getElementById("pegi").value
    let image = document.getElementById("formFile").value;

    if(nomJeu == "" || prix == "" || descrif == "" || genres == "" || plateforme == "" || pegi == "" || image == ""){
        sessionStorage.setItem("pegi", document.getElementById("pegi").selectedIndex);

        sessionStorage.setItem("nbGenre",document.getElementById("nbGenre").selectedIndex);
        sessionStorage.setItem("nbPlatform",document.getElementById("nbPlatform").selectedIndex);

        sessionStorage.setItem("nomJeu",document.getElementById("nomJeu").value);
        sessionStorage.setItem("prix",document.getElementById("prix").value);
        sessionStorage.setItem("description",document.getElementById("descrifJeu").value);

        isValid = false;
    }
    else { 
        sessionStorage.setItem("pegi", document.getElementById("pegi").options[0]);
        sessionStorage.setItem("nbGenre",document.getElementById("nbGenre").options[0]);
        sessionStorage.setItem("nbPlatform",document.getElementById("nbPlatform").options[0]);
        sessionStorage.setItem("nomJeu","");
        sessionStorage.setItem("prix","");
        sessionStorage.setItem("description","");
        sessionStorage.setItem("plateformes","");
        sessionStorage.setItem("genres","");
    }              
    return isValid;
}    
document.getElementById("nomJeu").value = sessionStorage.getItem('nomJeu')
document.getElementById("prix").value = sessionStorage.getItem('prix')
document.getElementById("descrifJeu").value = sessionStorage.getItem('description')
document.getElementById("selectedGenres").innerHTML = sessionStorage.getItem('genres');
document.getElementById("selectedPlateformes").innerHTML = sessionStorage.getItem('plateformes');
document.getElementById("pegi").options[sessionStorage.getItem("pegi")].selected = true ;
document.getElementById("nbGenre").options[sessionStorage.getItem("nbGenre")].selected = true ;
document.getElementById("nbPlatform").options[sessionStorage.getItem("nbPlatform")].selected = true ;