function VerifForm()
{
    let userName = document.getElementById('userName');
    let lastName = document.getElementById('lastName');
    let firstName= document.getElementById('firstName');
    let email = document.getElementById('email');
    let password = document.getElementById('password');
    let password2 = document.getElementById('password2');

    let message = 'error-msg-password2';

    if (userName.value === '') {
        document.getElementById('error-msg-userName').innerHTML= 'Veuillez indiquer votre nom d\'utilisateur';
        document.getElementById('error-msg-userName').style.display='block';
        document.getElementById('userName').focus();
        return false;
    }
    else
    {
        document.getElementById('error-msg-userName').style.display='none';
    }

    if (lastName.value === '')
    {
        document.getElementById('error-msg-lastName').innerHTML= 'Veuillez indiquer votre nom';
        document.getElementById('error-msg-lastName').style.display='block';
        document.getElementById('lastName').focus();
        return false;
    }
    else
    {
        document.getElementById('error-msg-lastName').style.display='none';
    }

    if (firstName.value === '')
    {
        document.getElementById('error-msg-firstName').innerHTML= 'Veuillez indiquer votre prénom';
        document.getElementById('error-msg-firstName').style.display='block';
        document.getElementById('firstName').focus();
        return false;
    }
    else
    {
        document.getElementById('error-msg-firstName').style.display='none';
    }

    if (email.value === '')
    {
        document.getElementById('error-msg-email').innerHTML= 'Veuillez indiquer votre email';
        document.getElementById('error-msg-email').style.display='block';
        document.getElementById('email').focus();
        return false;
    }
    else
    {
        document.getElementById('error-msg-email').style.display='none';
    }

    if (password.value === '')
    {
        document.getElementById('error-msg-password').innerHTML= 'Veuillez indiquer votre mot de passe';
        document.getElementById('error-msg-password').style.display='block';
        document.getElementById('password').focus();
        return false;
    }
    else
    {
        document.getElementById('error-msg-password').style.display='none';
    }

    if (password2.value === '')
    {
        document.getElementById('error-msg-password2').innerHTML= 'Veuillez confirmer votre mot de passe';
        document.getElementById('error-msg-password2').style.display='block';
        document.getElementById('password2').focus();
        return false;
    }
    else
    {
        document.getElementById('error-msg-password2').style.display='none';
    }

    if (password.value !== password2.value)
    {
        document.getElementById('error-msg-password2').innerHTML= 'les mots de passe ne sont pas identiques';
        document.getElementById('error-msg-password2').style.display='block';
        document.getElementById('password2').focus();
        return false;
    }
    else
    {
        document.getElementById('error-msg-password2').style.display='none';
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