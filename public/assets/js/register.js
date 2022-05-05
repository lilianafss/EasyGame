function VerifForm(error_message, sucess_message)
{
    let userName = document.getElementById('userName');
    let lastName = document.getElementById('lastName');
    let firstName= document.getElementById('firstName');
    let email = document.getElementById('email');
    let password = document.getElementById('password');
    let password2 = document.getElementById('password2');

    if (userName.value === '') {
        document.getElementById('error_msg').innerHTML += '<p class="error_msg"> -Veuillez indiquer votre nom d\'utilisateur</p>';
        document.getElementById('error_msg').style.display = 'block';
        document.getElementById('userName').focus();
    }
    else if(error_message === "pseudo")
    {
        document.getElementById('error_msg').innerHTML += '<p class="error_msg"> -Ce nom d\'utilisateur est déjà utilisé</p>';
        document.getElementById('error_msg').style.display = 'block';
        document.getElementById('userName').focus();
    }
    else
    {
        document.getElementById('error-msg-userName').style.display='none';
    }

    if (lastName.value === '')
    {
        document.getElementById('error_msg').innerHTML += '<p class="error_msg"> -Veuillez indiquer votre nom</p>';
        document.getElementById('error_msg').style.display = 'block';
        document.getElementById('lastName').focus();
    }

    if (firstName.value === '')
    {
        document.getElementById('error_msg').innerHTML += '<p class="error_msg"> -Veuillez indiquer votre prénom</p>';
        document.getElementById('error_msg').style.display = 'block';
        document.getElementById('firstName').focus();
    }

    if (email.value === '')
    {
        document.getElementById('error_msg').innerHTML += '<p class="error_msg"> -Veuillez indiquer votre email</p>';
        document.getElementById('error_msg').style.display = 'block';
        document.getElementById('email').focus();
    }
    else if(error_message === "email")
    {
        document.getElementById('error_msg').innerHTML += '<p class="error_msg"> -Cette adresse mail est déjà utilisée</p>';
        document.getElementById('error_msg').style.display = 'block';
        document.getElementById('email').focus();
    }

    if (password.value === '')
    {
        document.getElementById('error_msg').innerHTML += '<p class="error_msg"> -Veuillez indiquer votre mot de passe</p>';
        document.getElementById('error_msg').style.display = 'block';
        document.getElementById('password').focus();
    }

    if (password2.value === '')
    {
        document.getElementById('error_msg').innerHTML += '<p class="error_msg"> -Veuillez confirmer votre mot de passe</p>';
        document.getElementById('error_msg').style.display = 'block';
        document.getElementById('password2').focus();
    }
    else if (password.value !== password2.value)
    {
        document.getElementById('error_msg').innerHTML += '<p class="error_msg"> -les mots de passe ne sont pas identiques</p>';
        document.getElementById('error_msg').style.display = 'block';
        document.getElementById('password2').focus();
    }

    if(sucess_message === "sucess")
    {
        document.getElementById('sucess_message').style.display='block';
    }
    else
    {
        document.getElementById('sucess_message').style.display='none';
    }
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