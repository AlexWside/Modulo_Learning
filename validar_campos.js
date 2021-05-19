

function valida_dados (nomeform)
{
    if (nomeform.titulo.value=="")
    {
        alert ("Por favor digite o titulo.");
        return false;
    }

    if (nomeform.tipo.value=="")
    {
        alert ("Por favor digite o tipo.");
        return false;
    }

    if (nomeform.subtipo.value=="")
    {
        alert ("Por favor digite o sub-tipo.");
        return false;
    }

    if (nomeform.tempo.value=="")
    {
        alert ("Por favor digite a duração.");
        return false;
    }

    

    
return true;
}