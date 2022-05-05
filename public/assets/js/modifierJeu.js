function cliquerGenres(genre) {

    let nbGenre = document.getElementById("nbGenre").value;
    let tableau = "";
    let genreModel = genre;


    for (let i = 1; i <= nbGenre; i++) {
        tableau += '<select name="nbGenre' + i + '">';

        for (let i = 0; i < genreModel.length; i++) {
            tableau += '<option value="' + genreModel[i]['idGenre'] + '">' + genreModel[i]['genre'] + '</option>';
        }
        tableau += '</select><br>';
    }
    document.getElementById("selectedGenres").innerHTML = tableau;
}

function cliquerPlateformes(plateforme){

    let nbPlateforme = document.getElementById("nbPlatform").value;
    let tableau = "";
    let plateformeModel = plateforme;

    for (let i = 1; i <= nbPlateforme; i++) {
        tableau += '<select name="nbPlatform' + i + '">';

        for (let i = 0; i < plateformeModel.length; i++) {
            tableau += '<option value="' + plateformeModel[i]['idPlateforme'] + '">' + plateformeModel[i]['plateforme'] + '</option>';
        }
        tableau += '</select><br>';
    }
    document.getElementById("selectedPlateformes").innerHTML = tableau;
}