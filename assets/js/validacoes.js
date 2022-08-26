function validaEmail(email)
{
    let regex = /[a-z0-9]+@[a-z]+\.[a-z]{3}\.?[a-z]{0,2}$/;
    return regex.test(email.trim())
}

function validaTelefone(telefone)
{
    let regex = /^\+[0-9]{2}\([0-9]{2}\)[0-9]{5}-[0-9]{4}$/;

    return regex.test(telefone.replaceAll(" ", ""));
}