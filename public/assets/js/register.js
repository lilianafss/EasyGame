function VerifForm()
{
    // Récupère les valeurs du formulaire HTML
    let userName = document.getElementById('userName');
    let lastName = document.getElementById('lastName');
    let firstName= document.getElementById('firstName');
    let email = document.getElementById('email');
    let password = document.getElementById('password');
    let password2 = document.getElementById('password2');

    // Variable boolen qui valide ou pas le formulaire
    let isValid = true;

    // Efface le contenu de la div où sont stockés les messages d'erreurs
    document.getElementById('error_div').innerHTML = '';

    // Confirmation mot de passe
    if (password2.value === '')
    {
        ErrorMessage ('Veuillez confirmer votre mot de passe.', 'password2', 'false');
        isValid = false;
    }
    else if (password.value !== password2.value)
    {
        ErrorMessage ('Les mots de passe ne sont pas identiques.', 'password2', 'false');
        isValid = false;
    }

    // Mot de passe
    if (password.value === '')
    {
        ErrorMessage ('Veuillez indiquer votre mot de passe.', 'password', 'false');
    }

    // Email
    if (email.value === '')
    {
        ErrorMessage ('Veuillez indiquer votre email.', 'email', 'false');
    }

    // Prénom
    if (firstName.value === '')
    {
        ErrorMessage ('Veuillez indiquer votre prénom.', 'firstName', 'false');
    }

    // Nom
    if (lastName.value === '')
    {
        ErrorMessage ('Veuillez indiquer votre nom.', 'lastName', 'false');
    }

    // Pseudo
    if (userName.value === '')
    {
        ErrorMessage ('Veuillez indiquer votre nom d\'utilisateur.', 'userName', 'false');
    }
    return isValid;
}

/**
 * Affiche les messages d'erreurs et fait un focus sur l'input qui pose problème
 * @param {string} error_message
 * @param {string} id
 * @param isValid
 */
function ErrorMessage (error_message, id, isValid)
{
    document.getElementById('error_div').innerHTML += '<p class="error_msg">'+ error_message +'</p>';
    document.getElementById('error_div').style.display = 'flex';
    document.getElementById(id).focus();
    return isValid;
}

/**
 * Permet d'afficher ou de cacher le mot de passe
 * @constructor
 * @return true/false
 * @author Flavio Soares Rodrigues
 */
function HidePassword()
{
    let passwordField = document.getElementById("password");
    let passwordField2 = document.getElementById("password2");
    let checkBox = document.getElementById("showPassWord");

    if(checkBox.checked === true)
    {
        passwordField.type = "text";
        passwordField2.type = "text";
    }
    else if(checkBox.checked === false)
    {
        passwordField.type = "password";
        passwordField2.type = "password";
    }
}