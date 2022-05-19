function Message (statment, idInput)
{
    if (statment === "fail")
    {
        document.getElementById('msg').id = 'failMessage';
        document.getElementById(idInput).focus();
    }
    else if (statment === "success")
    {
        document.getElementById('msg').id = 'successMessage';
    }
}