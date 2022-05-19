function Message (statment)
{
    if (statment === "fail")
    {
        document.getElementById('message').style.display = 'block';
        document.getElementById('email').focus();
    }
    else if (statment === "sucess")
    {
        document.getElementById('message').style.display = 'block';
    }
}