function valida_dados(nomeform) {
    if (nomeform.titulo.value == "") {
        document.getElementById('titulo').style.borderColor = '#ff1919';
        alert("Por favor digite o titulo.");
        return false;
    }

    if (nomeform.tipo.value == "") {
        document.getElementById('tipo').style.borderColor = '#ff1919';
        alert("Por favor digite o tipo.");
        return false;
    }



    if (nomeform.tempo.value == "") {
        document.getElementById('tempo').style.borderColor = '#ff1919';
        alert("Por favor digite a duração.");
        return false;
    }




    return true;
}



function waittoinput() {
    setTimeout(function () {
        if ($('input[type="submit"]').prop('disabled', true)) {
            setTimeout(function () {
                $('input[type="submit"]').removeAttr('disabled');
            }, 5000);
        }
    }, 1);


}
