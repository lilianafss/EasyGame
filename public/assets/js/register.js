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