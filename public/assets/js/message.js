function Message (statment)
{
    if (statment === "fail")
    {
        document.getElementById('message').style.display = 'block';
        document.getElementById('message').style.background = 'rgba(200, 30, 50, 0.5)';
        document.getElementById('message').style.color = 'darkred';
        document.getElementById('message').style.border = '2px solid darkred';
        document.getElementById('email').focus();
    }
    else if (statment === "sucess")
    {
        document.getElementById('message').style.display = 'block';
        document.getElementById('message').style.background = 'rgba(30, 190, 50, 0.5)';
        document.getElementById('message').style.color = 'darkgreen';
        document.getElementById('message').style.border = '2px solid darkgreen';
    }
}